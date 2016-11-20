<?php

namespace Argentum\Assets;

class NamePersistentAssetPattern extends AssetPattern
{
    public function targetPath($sourcePath)
    {
        return str_replace('*', pathinfo($sourcePath, PATHINFO_BASENAME), parent::targetPath($sourcePath));
    }
}
