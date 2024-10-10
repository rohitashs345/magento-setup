<?php
/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains
 * the property of Adobe and its suppliers, if any. The intellectual
 * and technical concepts contained herein are proprietary to Adobe
 * and its suppliers and are protected by all applicable intellectual
 * property laws, including trade secret and copyright laws.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Adobe.
 */
declare(strict_types=1);

namespace Magento\OrderCancellationGraphQl\Model\Validator;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;

/**
 * Ensure all conditions to cancel order are met
 */
class ValidateRequest
{
    /**
     * Ensure customer is authorized and the field is populated
     *
     * @param array|null $input
     * @return void
     * @throws GraphQlInputException
     */
    public function execute(
        ?array $input,
    ): void {
        if (!is_array($input) || empty($input)) {
            throw new GraphQlInputException(
                __('CancelOrderInput is missing.')
            );
        }

        if (!$input['order_id'] || (int)$input['order_id'] === 0) {
            throw new GraphQlInputException(
                __(
                    'Required parameter "%field" is missing or incorrect.',
                    [
                        'field' => 'order_id'
                    ]
                )
            );
        }

        if (!$input['reason'] || !is_string($input['reason']) || (string)$input['reason'] === "") {
            throw new GraphQlInputException(
                __(
                    'Required parameter "%field" is missing or incorrect.',
                    [
                        'field' => 'reason'
                    ]
                )
            );
        }
    }
}