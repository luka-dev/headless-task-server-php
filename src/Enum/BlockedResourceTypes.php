<?php

namespace LuKa\HeadlessTaskServerPhp\Enum;

final class BlockedResourceTypes
{
    public const JsRuntime = 'JsRuntime';
    public const BlockJsAssets = 'BlockJsAssets';
    public const BlockCssAssets = 'BlockCssAssets';
    public const BlockImages = 'BlockImages';
    public const BlockFonts = 'BlockFonts';
    public const BlockIcons = 'BlockIcons';
    public const BlockMedia = 'BlockMedia';

    /**
     * @description Shortcut for BlockJsAssets, BlockCssAssets and BlockImages.
     */
    public const BlockAssets = 'BlockAssets';
    public const All = 'All';
    public const None = 'None';
}