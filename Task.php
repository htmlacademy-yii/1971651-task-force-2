<?php

    class Task implements TaskInterface
    {
        private int $workerId;
        private int $customerId;
        private string $status;

        private array $statuses = [
            self::STATUS_NEW    => 'Новое',
            self::STATUS_CANCEL => 'Отменено',
            self::STATUS_WORK   => 'В работе',
            self::STATUS_READY  => 'Выполнено',
            self::STATUS_FAIL   => 'Провалено',
        ];

        private array $actions = [
            self::ACTION_ACCEPT => 'Откликнуться',
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_READY  => 'Выполнено',
            self::ACTION_REFUSE => 'Отказаться',
        ];

        public function __construct(int $workerId, int $customerId)
        {
            $this->workerId = $workerId;
            $this->customerId = $customerId;
            $this->status = self::STATUS_NEW;
        }

        public function getNextStatus(string $action): array|string
        {
            $nextStatusOnAction = [
                self::STATUS_NEW => [
                    self::ACTION_ACCEPT => $this->statuses[self::STATUS_WORK],
                    self::ACTION_CANCEL => $this->statuses[self::STATUS_CANCEL],
                ],
                self::STATUS_WORK => [
                    self::ACTION_READY  => $this->statuses[self::STATUS_READY],
                    self::ACTION_REFUSE => $this->statuses[self::STATUS_FAIL],
                ],
            ];

            return $nextStatusOnAction[$this->status][$action] ?? "No {$action} action found for status";
        }

        public function getAvailableActions(string $status): array|string
        {
            $availableActionsOnStatus = [
                self::STATUS_NEW  => [$this->actions[self::ACTION_ACCEPT], $this->actions[self::ACTION_CANCEL]],
                self::STATUS_WORK => [$this->actions[self::ACTION_READY], $this->actions[self::ACTION_REFUSE]],
            ];

            return $availableActionsOnStatus[$status] ?? "{$status} status not found";
        }
    }
