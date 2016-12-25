<?php




defined('IN_IA') or exit('Access Denied');

class bj_qmxkModule extends WeModule {

    public function fieldsFormDisplay($rid = 0) {
        global $_W;
        $setting = $_W['account']['modules'][$this->_saveing_params['mid']]['config'];
        include $this->template('rule');
    }

    public function fieldsFormSubmit($rid = 0) {
        global $_GPC, $_W;
        if (!empty($_GPC['title'])) {
            $data = array(
                'title' => $_GPC['title'],
                'description' => $_GPC['description'],
                'picurl' => $_GPC['thumb-old'],
                'url' => create_url('mobile/module/list', array('name' => 'bj_qmxk', 'weid' => $_W['weid'])),
            );
            if (!empty($_GPC['thumb'])) {
                $data['picurl'] = $_GPC['thumb'];
                file_delete($_GPC['thumb-old']);
            }
            $this->saveSettings($data);
        }
        return true;
    }
 
    public function settingsDisplay($settings) {
        global $_GPC, $_W;
    	$theone = pdo_fetch('SELECT * FROM '.tablename('bj_qmxk_rules')." WHERE  weid = :weid" , array(':weid' => $_W['weid']));
		$id = $theone['id'];
        if (checksubmit()) {
			if(empty($_GPC['commtime']))
			{
			message('需要设置佣金申请周期');	
			}
			if(empty($_GPC['rebacktime']))
			{
			message('需要设置退换货期限');	
			}
			if(intval($_GPC['rebacktime'])>=intval($_GPC['commtime']))
			{
			message('退换货期限不能大于货到等于佣金申请周期');	
			}
            $cfg = array(
				'autofinish' => intval($_GPC['autofinish']),
				'agentRegister' => $_GPC['agentRegister'],
				'noticeemail' => $settings['noticeemail'],
				'shopname' => $_GPC['shopname'],
				'commtime' => intval($_GPC['commtime']),
				'rebacktime' => intval($_GPC['rebacktime']),
				'zhifuCommission' => $_GPC['zhifuCommission'],
				'globalCommissionLevel' => $_GPC['globalCommissionLevel'],
				'globalCommission' => $_GPC['globalCommission'],
				'globalCommission2' => $_GPC['globalCommission2'],
				'globalCommission3' => $_GPC['globalCommission3'],
				'indexss' => intval($_GPC['indexss']),
				'ydyy' => $_GPC['ydyy'],
				'paymsgTemplateid' => $settings['paymsgTemplateid'],
				'commissionType' => $_GPC['commissionType'],

				'address' => $_GPC['address'],
				'phone' => $_GPC['phone'],
				'kfcode' => $_GPC['kfcode'],
				//     'secret' => $_GPC['secret'],
				'officialweb' => $_GPC['officialweb'],
				'description'=>  $_GPC['description'],
				'footer' => $_GPC['footer'],
				'footerurl' => $_GPC['footerurl'],
				'minmoney' => $_GPC['minmoney'],
				'qq' => $_GPC['qq'],
				'orderstatus' => intval($_GPC['orderstatus'])
            );
            if (!empty($_GPC['logo'])) {
                $cfg['logo'] = $_GPC['logo'];
                file_delete($_GPC['logo-old']);
            }
            
			$this->saveSettings($cfg);
           
           	$clickcredit = $_GPC['clickcredit'];
			if(!is_numeric($clickcredit)){
				message('点击或扫描积分请输入合法数字！');
			}
			if($_GPC['promotertimes']=='2')
			{				
				if(!is_numeric($_GPC['promotercount'])){
					message('达到单数请输入合法数字！');
				}				
			}
			if($_GPC['promotertimes']=='3')
			{				
				if(!is_numeric($_GPC['promotermoney'])){
					message('达到金额请输入合法数字！');
				}				
			}
			
			$insert = array(
				'weid' => $_W['weid'],
				'clickcredit' => $clickcredit,
				'rule' => htmlspecialchars_decode($_GPC['rule']),
				'commtime' => 0,
				'promotertimes' => $_GPC['promotertimes'],
				'promotermoney' => $_GPC['promotermoney'],
				'promotercount' => $_GPC['promotercount'],
				'createtime' => TIMESTAMP
			);
			if(empty($id)) {
				pdo_insert('bj_qmxk_rules', $insert);
			} else {
				pdo_update('bj_qmxk_rules', $insert,array('id' => $id));
			}
							
           
            message('保存成功', 'refresh');
        }
        if(empty($settings['footer']))
        {
        	
        $settings['footer']=$_W['account']['name'];	
        }
 
        include $this->template('setting');
    }

}
