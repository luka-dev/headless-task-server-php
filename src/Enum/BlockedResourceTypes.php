<?php

namespace LuKa\HeadlessTaskServerPhp\Enum;

final class BlockedResourceTypes
{
    public const JsRuntime = 'JsRuntime';
    public const BlockJsAssets = 'BlockJsAssets';
    public const BlockCssAssets = 'BlockCssAssets';
    public const BlockImages = 'BlockImages';
    public const BlockAssets = 'BlockAssets'; //Shortcut for LoadJsAssets, LoadCssAssets and LoadImages.
    public const All = 'All';
    public const None = 'None';
}