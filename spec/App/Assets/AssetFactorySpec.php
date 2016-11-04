<?php

namespace spec\App\Assets;

use App\Assets\Asset;
use App\Assets\AssetFactory;
use App\Assets\AssetPattern;
use App\Assets\Exception\FileNotFound;
use App\Assets\Filter\CssMinFilter;
use App\Assets\Filter\LessFilter;
use App\Assets\FilterManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AssetFactorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(realpath(__DIR__ . '/../../fixtures/assets'));
        $this->setPattern('plain', new AssetPattern('/tmp/*'));
    }

    function it_fail_if_file_not_found()
    {
        $this->shouldThrow(FileNotFound::class)->during('file', ['plain', 'lolwut']);
    }

    function it_can_have_filter_manager()
    {
        $fm = new FilterManager();
        $fm->set('less', new LessFilter());
        $fm->set('css_min', new CssMinFilter());
        $this->setFilterManager($fm);
    }

    function it_creates_named_assets()
    {
        $asset = $this->file('plain', 'foo', 'lol');
        $asset->name()->shouldBeEqualTo('lol');
    }

    function it_use_source_path_as_name_if_name_is_null()
    {
        $asset = $this->file('plain', 'foo');
        $asset->name()->shouldBeEqualTo('foo');
    }

    function it_have_asset_patterns()
    {
        $this->setPattern('css', new AssetPattern('/tmp/*.css', ['less']));
    }

    function it_creates_assets_by_patterns()
    {
        $filter = new LessFilter();

        $fm = new FilterManager();
        $fm->set('less', $filter);
        $this->setFilterManager($fm);
        $this->setPattern('css', new AssetPattern('/tmp/*.css', ['less']));

        $asset = $this->file('css', 'bar');
        $asset->shouldBeAnInstanceOf(Asset::class);
        $asset->filters()->shouldContain($filter);
        $asset->targetPath()->shouldStartWith('/tmp/');
        $asset->targetPath()->shouldEndWith('.css');
    }

    function it_merges_filters()
    {
        $filter = new LessFilter();
        $newFilter = new LessFilter();

        $fm = new FilterManager();
        $fm->set('less', $filter);
        $fm->set('new_less', $newFilter);
        $this->setFilterManager($fm);
        $this->setPattern('css', new AssetPattern('/tmp/*.css', ['less']));

        $asset = $this->file('css', 'bar', ['new_less']);
        $asset->filters()->shouldBeEqualTo([$filter, $newFilter]);
    }

    function it_resolves_filters_by_they_name_from_filter_manager()
    {
        $filter = new LessFilter();
        $newFilter = new LessFilter();

        $fm = new FilterManager();
        $fm->set('less', $filter);
        $fm->set('new_less', $newFilter);
        $this->setFilterManager($fm);
        $this->setPattern('css', new AssetPattern('/tmp/*.css', ['less']));

        $asset = $this->file('css', 'foo', ['new_less']);
        $asset->filters()->shouldContain($filter);
        $asset->filters()->shouldContain($newFilter);
    }

    function it_can_have_namespaces()
    {
        $this->setNamespace('kek', realpath(__DIR__ . '/../../fixtures/assets/kek'));
    }

    function it_resolves_paths_by_namespace()
    {
        $this->setNamespace('kek', realpath(__DIR__ . '/../../fixtures/assets/kek'));

        $asset = $this->file('plain', 'kek::lol');
        $asset->sourcePath()->shouldEndWith('fixtures/assets/kek/lol');
    }

    function it_passes_self_to_asset()
    {
        $asset = $this->file('plain', 'foo');
        $asset->assetFactory()->shouldBeEqualTo($this);
    }
}
