<?php
namespace Mall\Model;

class GoodsModel extends MallModel
{
    protected $tableName='goods';
    protected $pkId = 'goods_id';
    
    const STATE1 = 1;       // 出售中
    const STATE0 = 0;       // 下架
    const STATE10 = 10;     // 违规
    const VERIFY1 = 1;      // 审核通过
    const VERIFY0 = 0;      // 审核失败
    const VERIFY10 = 10;    // 等待审核
    
    /**
     * 出售中的商品SKU列表（只显示不同颜色的商品，前台商品索引，店铺也商品列表等使用）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param number $page
     * @return array
     */
    public function getGoodsListByColorDistinct($condition, $field = array(), $order = 'goods_id asc', $pagesize = 0)
    {
        if(empty($field))
		{
			$field = '*';
		}
		if (is_array($field))
		{
			$field = implode(',', $field);
		}
		
        $field = "CONCAT(goods_commonid,'_',color_id) as nc_distinct ," . $field ;

        //$count = $this->getGoodsOnlineCount($condition,"distinct CONCAT(goods_commonid,'_',color_id)");
        $goods_list = array();
        
        $goods_list = $this->getGoodsOnlineList($condition, $field, $pagesize, $order, 0, 'nc_distinct', false);
        
        return $goods_list;
    }
    
    /**
     * 获得出售中商品SKU数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsOnlineCount($condition, $field = array(), $group = '') {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->count($condition,$field,$group);
    }
    /**
     * 在售商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGoodsOnlineList($condition, $field = array(), $pagesize = 0, $order = 'goods_id desc', $limit = 0, $group = '', $lock = false) {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        $page = $this->_container->getApp()->getRequest()->getGet('page');
        return $this->listInfo($condition, $field, $order,$page,$pagesize,$group);
    }
}

?>