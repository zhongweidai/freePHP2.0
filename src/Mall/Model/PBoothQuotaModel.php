<?php
namespace Mall\Model;

class PBoothQuotaModel extends MallModel
{
    protected $tableName = 'p_booth_quota';
    
    protected $pkId = 'booth_quota_id';

    const STATE1 = 1;       // 开启
    const STATE0 = 0;       // 关闭
}

?>