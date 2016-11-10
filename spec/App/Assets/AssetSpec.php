<?php

namespace spec\App\Assets;

use App\Assets\Asset;
use App\Assets\AssetFactory;
use App\Assets\AssetPattern;
use App\Assets\Filter\LessFilter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AssetSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('foo', realpath(__DIR__ . '/../../fixtures/assets/foo'), '/tmp/*', [new LessFilter()]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Asset::class);
    }

    public function it_has_name()
    {
        $this->name()->shouldBeEqualTo('foo');
    }

    public function it_has_source_path()
    {
        $this->sourcePath()->shouldBeEqualTo(realpath(__DIR__ . '/../../fixtures/assets/foo'));
    }

    public function it_has_content_from_file()
    {
        $this->content()->shouldBeEqualTo('foo');
    }

    public function it_has_filters()
    {
        $this->filters()->shouldBeLike([new LessFilter()]);
    }

    public function it_generates_unique_target_path()
    {
        $assets = [
            new Asset('foo', realpath(__DIR__ . '/../../fixtures/assets/baz'), '/tmp/*', [new LessFilter()]),
            new Asset('foo', realpath(__DIR__ . '/../../fixtures/assets/foo'), '/tmp/*.css', [new LessFilter()]),
            new Asset('foo', realpath(__DIR__ . '/../../fixtures/assets/foo'), '/tmp/*'),
        ];
        foreach ($assets as $asset) {
            $this->targetPath()->shouldNotBeEqualTo($asset->targetPath());
        }
    }

    public function it_can_depend_on_other_assets()
    {
        $this->dependsOn(new Asset('foo', realpath(__DIR__ . '/../../fixtures/assets/baz'), '/tmp/*', [new LessFilter()]));
    }

    public function it_can_depend_by_name_or_source()
    {
        $this->dependsOn('bar');
        $this->dependencies()->shouldHaveCount(1);
        $this->dependsOn('bar/baz.css');
        $this->dependencies()->shouldHaveCount(2);
    }

    public function it_can_construct_asset_by_given_params_while_depending_on_it()
    {
        $path = realpath(__DIR__ . '/../../fixtures/assets/baz');
        $factory = new AssetFactory(dirname($path));
        $factory->setPattern('plain', new AssetPattern('/tmp/*'));
        $this->setAssetFactory($factory);
        $this->dependsOn('plain', $path, 'name', [new LessFilter()]);
        $this->dependencies()->shouldHaveCount(1);
    }

    public function it_can_construct_asset_by_given_params_and_factory_while_depending_on_it()
    {
        $path = realpath(__DIR__ . '/../../fixtures/assets/baz');
        $factory = new AssetFactory(dirname($path));
        $factory->setPattern('plain', new AssetPattern('/tmp/*'));
        $this->dependsOn('plain', $path, 'name', [new LessFilter()], $factory);
        $this->dependencies()->shouldHaveCount(1);
    }
}
