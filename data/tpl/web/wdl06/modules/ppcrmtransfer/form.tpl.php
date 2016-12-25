<?php defined('IN_IA') or exit('Access Denied');?><div class="span6 alert alert-info">
	如果你要使用腾讯提供的多客服系统, 请添加本条规则. <br />
	这个功能是配合微信公众平台的多客服功能使用的, <a href="http://wkd.qq.com/php/static/mp/html/guide.html">了解详情</a> <br />
	注意: 请添加关键字为 [高级] - [直接接管] <br />
	注意: <span style="color:red;">不要</span>设置为置顶规则. <br />
</div>

<div class="span6 alert alert-info">
	<p>
		直接接管说明: 直接接管功能是配合优先级使用的. <br /> 
		比如一条规则, 优先级是 10, 触发设置为直接接管. 那么当消息到达时, 优先处理优先级大于10的规则. 如果没有优先级大于10的规则, 或者优先级大于10的规则都没有任何有效回复. 那么直接使用这条规则.
	</p>
	<p>
		腾讯多客服功能说明: 如果粉丝发送了一条消息, 如果没有任何有效的规则能够处理. 那么将会把这条消息转发至腾讯多客服系统. 使用多客服客户端的客服人员如果接入了这条消息(接待本次客服对话)后, 以后的消息都将发送至多客服系统(<span style="color:red;">不会继续把消息发送至本系统</span>) <br />
		直到客服人员关闭本地对话, 公众平台官方才会继续把消息发送至本系统进行处理. <br />
		<span style="color:red;">因此, 客服人员接待完成后, 一定要点击关闭按钮来结束客服接待. 否则本平台不会生效.</span>
	</p>
</div>