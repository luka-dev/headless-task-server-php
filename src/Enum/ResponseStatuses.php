<?php

namespace LuKa\HeadlessTaskServerPhp\Enum;

final class ResponseStatuses
{
    public const RESOLVE = 'RESOLVE';
    public const REJECT = 'REJECT';
    public const THROW = 'THROW';
    public const INIT_ERROR = 'INIT_ERROR';
    public const BAD_ARGS = 'BAD_ARGS';
    public const QUEUE_TIMEOUT = 'QUEUE_TIMEOUT';
    public const INIT_TIMEOUT = 'INIT_TIMEOUT';
    public const SESSION_TIMEOUT = 'SESSION_TIMEOUT';
}