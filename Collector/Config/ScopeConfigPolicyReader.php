<?php
/**
 * Copyright © MagEx Digital All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagEx\ContentSecurityPolicy\Collector\Config;

use Magento\Csp\Api\Data\PolicyInterface;
use MagEx\ContentSecurityPolicy\Model\Policy\MagExPolicy;
use Magento\Csp\Model\Collector\Config\PolicyReaderInterface;
use Magento\Csp\Model\Policy\FetchPolicy;

class ScopeConfigPolicyReader implements PolicyReaderInterface
{

    const XML_PATCH_CONFIG_RESOURCE_BASE = 'csp/configuration/';

    /**
     * store config data
     * @var null
     */
    private static $cofigData = null;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getCspConfigs($storeId = null)
    {
        if(null == self::$cofigData) {
            self::$cofigData = [];
            foreach (MagExPolicy::POLICIES as $key) {
                $patchName = str_replace('-', '_', $key);
                $value = $this->scopeConfig->getValue(static::XML_PATCH_CONFIG_RESOURCE_BASE . $patchName,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $storeId);
                self::$cofigData[$key] = $value;
            }
        }
        return self::$cofigData;
    }

    public function read(string $id, $value): PolicyInterface
    {
        $configData = $this->getCspConfigs();
        $value['hosts'] = [];
        if(!empty($configData['global'])){
            $value['hosts'] = explode(',', $configData['global']);
        }
        if(!empty($configData[$id])){
            $value['hosts'] = array_merge($value['hosts'], explode(',', $configData[$id]));
        }
        return new MagExPolicy(
            $id,
            !empty($value['none']),
            !empty($value['hosts']) ? array_values($value['hosts']) : [],
            !empty($value['schemes']) ? array_values($value['schemes']) : [],
            !empty($value['self']),
            !empty($value['inline']),
            !empty($value['eval']),
            [],
            [],
            !empty($value['dynamic']),
            !empty($value['event_handlers'])
        );
    }

    public function canRead(string $id): bool
    {
        return in_array($id, MagExPolicy::POLICIES, true);
    }
}
