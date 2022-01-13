<?php

interface TaskInterface
{
    const STATUS_NEW    = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_WORK   = 'work';
    const STATUS_READY  = 'ready';
    const STATUS_FAIL   = 'fail';

    const ACTION_ACCEPT = 'accept';
    const ACTION_CANCEL = 'cancel';
    const ACTION_READY  = 'ready';
    const ACTION_REFUSE = 'refuse';

    function getNextStatus(string $action);
    function getAvailableActions(string $status);
}
