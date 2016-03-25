<?php
namespace Mall\Model;
use Component\Model\FreeModel;

class PBoothQuotaModel extends FreeModel
{
    protected $tableName = 'p_booth_quota';
    
    protected $pkId = 'booth_quota_id';

    const STATE1 = 1;       // 开启
    const STATE0 = 0;       // 关闭
}

?>