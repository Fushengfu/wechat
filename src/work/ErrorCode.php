<?php
/**
 * error code 说明.
 * <ul>
 *    <li>-40001: 签名验证错误</li>
 *    <li>-40002: xml解析失败</li>
 *    <li>-40003: sha加密生成签名失败</li>
 *    <li>-40004: encodingAesKey 非法</li>
 *    <li>-40005: corpid 校验错误</li>
 *    <li>-40006: aes 加密失败</li>
 *    <li>-40007: aes 解密失败</li>
 *    <li>-40008: 解密后得到的buffer非法</li>
 *    <li>-40009: base64加密失败</li>
 *    <li>-40010: base64解密失败</li>
 *    <li>-40011: 生成xml失败</li>
 * </ul>
 */
namespace Fushengfu\Wechat\work;

class ErrorCode
{
	public static $OK = 0;
	public static $ValidateSignatureError = -40001;
	public static $ParseXmlError = -40002;
	public static $ComputeSignatureError = -40003;
	public static $IllegalAesKey = -40004;
	public static $ValidateCorpidError = -40005;
	public static $EncryptAESError = -40006;
	public static $DecryptAESError = -40007;
	public static $IllegalBuffer = -40008;
	public static $EncodeBase64Error = -40009;
	public static $DecodeBase64Error = -40010;
	public static $GenReturnXmlError = -40011;

	public static $errCode = [
		'-1'=>	'系统繁忙	服务器暂不可用，建议稍候重试。建议重试次数不超过3次。',
		'0' =>	'请求成功	接口调用成功',
		'40001'=> '不合法的secret参数	secret在应用详情/通讯录管理助手可查看',
		'40003'=> '无效的UserID',
		'40004'=> '不合法的媒体文件类型	不满足系统文件要求。参考：上传的媒体文件限制',
		'40005'=> '不合法的type参数	合法的type取值，参考：上传临时素材',
		'40006'=> '不合法的文件大小	系统文件要求，参考：上传的媒体文件限制',
		'40007'=> '不合法的media_id参数',
		'40008'=> '不合法的msgtype参数	合法的msgtype取值，参考：消息类型',
		'40009'=> '上传图片大小不是有效值	图片大小的系统限制，参考上传的媒体文件限制',
		'40011'=> '上传视频大小不是有效值	视频大小的系统限制，参考上传的媒体文件限制',
		'40013'=> '不合法的CorpID	需确认CorpID是否填写正确，在 web管理端-设置 可查看',
		'40014'=> '不合法的access_token',
		'40016'=> '不合法的按钮个数	菜单按钮1-3个',
		'40017'=> '不合法的按钮类型	支持的类型，参考：按钮类型',
		'40018'=> '不合法的按钮名字长度	长度应不超过16个字节',
		'40019'=> '不合法的按钮KEY长度	长度应不超过128字节',
		'40020'=> '不合法的按钮URL长度	长度应不超过1024字节',
		'40022'=> '不合法的子菜单级数	只能包含一级菜单和二级菜单',
		'40023'=> '不合法的子菜单按钮个数	子菜单按钮1-5个',
		'40024'=> '不合法的子菜单按钮类型	支持的类型，参考：按钮类型',
		'40025'=> '不合法的子菜单按钮名字长度	支持的类型，参考：按钮类型',
		'40026'=> '不合法的子菜单按钮KEY长度',
		'40027'=> '不合法的子菜单按钮URL长度	长度应不超过1024字节',
		'40029'=> '不合法的oauth_code',
		'40031'=> '不合法的UserID列表	指定的UserID列表，至少存在一个UserID不在通讯录中',
		'40032'=> '不合法的UserID列表长度',
		'40033'=> '不合法的请求字符	不能包含\uxxxx格式的字符',
		'40035'=> '不合法的参数',
		'40039'=> '不合法的url长度	url长度限制1024个字节',
		'40050'=> 'chatid不存在	会话需要先创建后，才可修改会话详情或者发起聊天',
		'40054'=> '不合法的子菜单url域名',
		'40055'=> '不合法的菜单url域名',
		'40056'=> '不合法的agentid',
		'40057'=> '不合法的callbackurl或者callbackurl验证失败	可自助到开发调试工具重现',
		'40058'=> '不合法的参数	传递参数不符合系统要求，需要参照具体API接口说明',
		'40059'=> '不合法的上报地理位置标志位	开关标志位只能填 0 或者 1',
		'40063'=> '参数为空',
		'40066'=> '不合法的部门列表	部门列表为空，或者至少存在一个部门ID不存在于通讯录中',
		'40068'=> '不合法的标签ID	标签ID未指定，或者指定的标签ID不存在',
		'40070'=> '指定的标签范围结点全部无效',
		'40071'=> '不合法的标签名字	标签名字已经存在',
		'40072'=> '不合法的标签名字长度	不允许为空，最大长度限制为32个字（汉字或英文字母）',
		'40073'=> '不合法的openid	openid不存在，需确认获取来源',
		'40074'=> 'news消息不支持保密消息类型	图文消息支持保密类型需改用mpnews',
		'40077'=> '不合法的pre_auth_code参数	预授权码不存在，参考：获取预授权码',
		'40078'=> '不合法的auth_code参数	需确认获取来源，并且只能消费一次',
		'40080'=> '不合法的suite_secret	套件secret可在第三方管理端套件详情查看',
		'40082'=> '不合法的suite_token',
		'40083'=> '不合法的suite_id	suite_id不存在',
		'40084'=> '不合法的permanent_code参数',
		'40085'=> '不合法的的suite_ticket参数	suite_ticket不存在或者已失效',
		'40086'=> '不合法的第三方应用appid	至少有一个不存在应用id',
		'40088'=> 'jobid不存在	请检查 jobid 来源',
		'40089'=> '批量任务的结果已清理	系统仅保存最近5次批量任务的结果。可在通讯录查看实际导入情况',
		'40091'=> 'secret不合法	可能用了别的企业的secret',
		'40092'=> '导入文件存在不合法的内容',
		'40093'=> '不合法的jsapi_ticket参数	ticket已失效，或者拼写错误',
		'40094'=> '不合法的URL	缺少主页URL参数，或者URL不合法（链接需要带上协议头，以 http:// 或者 https:// 开头）',
		'40096'=> '不合法的外部联系人userid',
		'40097'=> '该成员尚未离职	离职成员外部联系人转移接口要求转出用户必须已经离职',
		'40098'=> '接替成员尚未实名认证	离职成员外部联系人转移接口要求接替成员已实名认证',
		'40099'=> '接替成员的外部联系人数量已达上限',
		'40100'=> '此用户的外部联系人已经在转移流程中',
		'40102'=> '域名或IP不可与应用市场上架应用重复',
		'40123'=> '上传临时图片素材，图片格式非法	请确认上传的内容是否为合法的图片内容',
		'41001'=> '缺少access_token参数',
		'41002'=> '缺少corpid参数',
		'41004'=> '缺少secret参数',
		'41006'=> '缺少media_id参数	media_id为调用接口必填参数，请确认是否有传递',
		'41008'=> '缺少auth code参数',
		'41009'=> '缺少userid参数',
		'41010'=> '缺少url参数',
		'41011'=> '缺少agentid参数',
		'41016'=> '缺少title参数	发送图文消息，标题是必填参数。请确认参数是否有传递。',
		'41019'=> '缺少 department 参数',
		'41017'=> '缺少tagid参数',
		'41021'=> '缺少suite_id参数',
		'41022'=> '缺少suite_access_token参数',
		'41023'=> '缺少suite_ticket参数',
		'41024'=> '缺少secret参数',
		'41025'=> '缺少permanent_code参数',
		'41033'=> '缺少 description 参数	发送文本卡片消息接口，description 是必填字段',
		'41035'=> '缺少外部联系人userid参数',
		'41036'=> '不合法的企业对外简称	企业对外简称必须是认证过的，如果要改回默认简称，传空字符串把对外简称清除就可以了',
		'41037'=> '缺少「联系我」type参数',
		'41038'=> '缺少「联系我」scene参数',
		'41039'=> '无效的「联系我」type参数',
		'41040'=> '无效的「联系我」scene参数',
		'41041'=> '「联系我」使用人数超过限制	默认限制不超过100人(包括部门展开后的人数)',
		'41042'=> '无效的「联系我」style参数',
		'41043'=> '缺少「联系我」config_id参数',
		'41044'=> '无效的「联系我」config_id参数',
		'41045'=> 'API添加「联系我」达到数量上限',
		'41046'=> '缺少企业群发消息id',
		'41047'=> '无效的企业群发消息id',
		'41048'=> '无可发送的客户',
		'41049'=> '缺少欢迎语code参数',
		'41050'=> '无效的欢迎语code	欢迎语code(welcome_code)具有时效性，须在添加好友后20秒内使用',
		'41051'=> '客户和服务人员已经开始聊天了	已经开始的聊天的客户不能发送欢迎语',
		'41052'=> '无效的发送时间',
		'41053'=> '客户未同意聊天存档	须外部联系人同意服务须知后，成员才可发送欢迎语',
		'41054'=> '该用户尚未激活',
		'41055'=> '群欢迎语模板数量达到上限',
		'41056'=> '外部联系人id类型不正确',
		'41057'=> '企业或服务商未绑定微信开发者账号',
		'41102'=> '缺少菜单名',
		'42001'=> 'access_token已过期	access_token有时效性，需要重新获取一次',
		'42007'=> 'pre_auth_code已过期	pre_auth_code有时效性，需要重新获取一次',
		'42009'=> 'suite_access_token已过期	suite_access_token有时效性，需要重新获取一次',
		'42013'=> '小程序未登陆或登录态已经过期	需要重新走登陆流程',
		'42014'=> '任务卡片消息的task_id不合法',
		'42015'=> '更新的消息的应用与发送消息的应用不匹配',
		'42016'=> '更新的task_id不存在',
		'42017'=> '按钮key值不存在',
		'42018'=> '按钮key值不合法',
		'42019'=> '缺少按钮key值不合法',
		'42020'=> '缺少按钮名称',
		'42021'=> 'device_access_token 过期',
		'42022'=> 'code已经被使用过。只能使用一次',
		'43004'=> '指定的userid未绑定微信或未关注微工作台（原企业号）	需要成员使用微信登录企业微信或者关注微工作台才能获取openid',
		'43009'=> '企业未验证主体',
		'44001'=> '多媒体文件为空	上传格式参考：上传临时素材，确认header和body的内容正确。',
		'44004'=> '文本消息content参数为空	发文本消息content为必填参数，且不能为空',
		'45001'=> '多媒体文件大小超过限制	图片不可超过5M；音频不可超过5M；文件不可超过20M',
		'45002'=> '消息内容大小超过限制',
		'45004'=> '应用description参数长度不符合系统限制	设置应用若带有description参数，则长度必须为4至120个字符',
		'45007'=> '语音播放时间超过限制	语音播放时长不能超过60秒',
		'45008'=> '图文消息的文章数量不符合系统限制	图文消息的文章数量不能超过8条',
		'45009'=> '接口调用超过限制',
		'45022'=> '应用name参数长度不符合系统限制	设置应用若带有name参数，则不允许为空，且不超过32个字符',
		'45024'=> '帐号数量超过上限',
		'45026'=> '触发删除用户数的保护	限制参考：全量覆盖成员',
		'45029'=> '回包大小超过上限',
		'45032'=> '图文消息author参数长度超过限制	最长64个字节',
		'45033'=> '接口并发调用超过限制',
		'46003'=> '菜单未设置	菜单需发布后才能获取到数据',
		'46004'=> '指定的用户不存在	需要确认指定的用户存在于通讯录中',
		'48002'=> 'API接口无权限调用',
		'48003'=> '不合法的suite_id	确认suite_access_token由指定的suite_id生成',
		'48004'=> '授权关系无效	可能是无授权或授权已被取消',
		'48005'=> 'API接口已废弃	接口已不再支持，建议改用新接口或者新方案',
		'48006'=> '接口权限被收回	由于企业长时间未使用应用，接口权限被收回，需企业管理员重新启用',
		'50001'=> 'redirect_url未登记可信域名',
		'50002'=> '成员不在权限范围	请检查应用或管理组的权限范围',
		'50003'=> '应用已禁用',
		'60001'=> '部门长度不符合限制	部门名称不能为空且长度不能超过32个字',
		'60003'=> '部门ID不存在	需要确认部门ID是否有带，并且存在通讯录中',
		'60004'=> '父部门不存在	需要确认父亲部门ID是否有带，并且存在通讯录中',
		'60005'=> '部门下存在成员	不允许删除有成员的部门',
		'60006'=> '部门下存在子部门	不允许删除有子部门的部门',
		'60007'=> '不允许删除根部门',
		'60008'=> '部门已存在	部门ID或者部门名称已存在',
		'60009'=> '部门名称含有非法字符	不能含有 \:?*“<>| 等字符',
		'60010'=> '部门存在循环关系',
		'60011'=> '指定的成员/部门/标签参数无权限',
		'60012'=> '不允许删除默认应用	默认应用的id为0',
		'60020'=> '访问ip不在白名单之中',
		'60021'=> 'userid不在应用可见范围内',
		'60028'=> '不允许修改第三方应用的主页 URL	第三方应用类型，不允许通过接口修改该应用的主页 URL',
		'60102'=> 'UserID已存在',
		'60103'=> '手机号码不合法	长度不超过32位，字符仅支持数字，加号和减号',
		'60104'=> '手机号码已存在	同一个企业内，成员的手机号不能重复。建议更换手机号，或者更新已有的手机记录。',
		'60105'=> '邮箱不合法	长度不超过64位，且为有效的email格式',
		'60106'=> '邮箱已存在	同一个企业内，成员的邮箱不能重复。建议更换邮箱，或者更新已有的邮箱记录。',
		'60107'=> '微信号不合法	微信号格式由字母、数字、”-“、”_“组成，长度为 3-20 字节，首字符必须是字母或”-“或”_“',
		'60110'=> '用户所属部门数量超过限制	用户同时归属部门不超过20个',
		'60111'=> 'UserID不存在	UserID参数为空，或者不存在通讯录中',
		'60112'=> '成员name参数不合法	不能为空，且不能超过64字符',
		'60123'=> '无效的部门id	部门不存在通讯录中',
		'60124'=> '无效的父部门id	父部门不存在通讯录中',
		'60125'=> '非法部门名字	不能为空，且不能超过64字节，且不能含有\:*?”<>|等字符',
		'60127'=> '缺少department参数',
		'60129'=> '成员手机和邮箱都为空	成员手机和邮箱至少有个非空',
		'60132'=> 'is_leader_in_dept和department的元素个数不一致',
		'60136'=> '记录不存在',
		'60137'=> '家长手机号重复	同一个家校通讯录中，家长的手机号不能重复。建议更换手机号，或者更新已有的手机记录。',
		'65000'=> '学校已经迁移',
		'65001'=> '无效的关注模式',
		'65002'=> '导入家长信息数量过多	批量导入家长每次最多1000个',
		'65003'=> '学校尚未迁移',
		'65004'=> '组织架构不存在',
		'65005'=> '无效的同步模式',
		'65006'=> '无效的管理员类型',
		'65007'=> '无效的家校部门类型',
		'65008'=> '无效的入学年份',
		'65009'=> '无效的标准年级类型',
		'65010'=> '此userid并不是学生',
		'65011'=> '家长userid数量超过限制	每次最多批量处理100个家长',
		'65012'=> '学生userid数量超过限制	每次最多批量处理10个学生',
		'65013'=> '学生已有家长',
		'65014'=> '非学校企业',
		'65015'=> '父部门类型不匹配	添加学校部门，需满足层级关机，班级需要以年级为父部门',
		'72023'=> '发票已被其他公众号锁定',
		'72024'=> '发票状态错误	reimburse_status状态错误，参考：更新发票状态',
		'72037'=> '存在发票不属于该用户	只能批量更新该openid的发票，参考：批量更新发票状态',
		'80001'=> '可信域名不正确，或者无ICP备案',
		'81001'=> '部门下的结点数超过限制（3W）',
		'81002'=> '部门最多15层',
		'81003'=> '标签下节点个数超过30000个',
		'81011'=> '无权限操作标签',
		'81012'=> '缺失可见范围	请求没有填写UserID、部门ID、标签ID',
		'81013'=> 'UserID、部门ID、标签ID全部非法或无权限',
		'81014'=> '标签添加成员，单次添加user或party过多',
		'81015'=> '邮箱域名需要跟企业邮箱域名一致',
		'81016'=> 'logined_userid字段缺失',
		'81017'=> 'items字段大小超过限制（20）',
		'81018'=> '该服务商可获取名字数量配额不足',
		'81019'=> 'items数组成员缺少id字段',
		'81020'=> 'items数组成员缺少type字段',
		'81021'=> 'items数组成员的type字段不合法',
		'82001'=> '指定的成员/部门/标签全部为空',
		'82002'=> '不合法的PartyID列表长度	发消息，单次不能超过100个部门',
		'82003'=> '不合法的TagID列表长度	发消息，单次不能超过100个标签',
		'84014'=> '成员票据过期',
		'84015'=> '成员票据无效	确认user_ticket参数来源是否正确。参考接口：根据code获取成员信息',
		'84019'=> '缺少templateid参数',
		'84020'=> 'templateid不存在	确认参数是否有带，并且已创建',
		'84021'=> '缺少register_code参数',
		'84022'=> '无效的register_code参数',
		'84023'=> '不允许调用设置通讯录同步完成接口',
		'84024'=> '无注册信息',
		'84025'=> '不符合的state参数	必须是[a-zA-Z0-9]的参数值，长度不可超过128个字节',
		'84052'=> '缺少caller参数',
		'84053'=> '缺少callee参数',
		'84054'=> '缺少auth_corpid参数',
		'84055'=> '超过拨打公费电话频率	同一个客服5秒内只能调用api拨打一次公费电话',
		'84056'=> '被拨打用户安装应用时未授权拨打公费电话权限',
		'84057'=> '公费电话余额不足',
		'84058'=> 'caller 呼叫号码不支持',
		'84059'=> '号码非法',
		'84060'=> 'callee 呼叫号码不支持',
		'84061'=> '不存在外部联系人的关系',
		'84062'=> '未开启公费电话应用',
		'84063'=> 'caller不存在',
		'84064'=> 'callee不存在',
		'84065'=> 'caller跟callee电话号码一致	不允许自己拨打给自己',
		'84066'=> '服务商拨打次数超过限制	单个企业管理员，在一天（以上午10:00为起始时间）内，对应单个服务商，只能被呼叫【4】次。',
		'84067'=> '管理员收到的服务商公费电话个数超过限制	单个企业管理员，在一天（以上午10:00为起始时间）内，一共只能被【3】个服务商成功呼叫。',
		'84069'=> '拨打方被限制拨打公费电话',
		'84070'=> '不支持的电话号码	拨打方或者被拨打方电话号码不支持',
		'84071'=> '不合法的外部联系人授权码	非法或者已经消费过',
		'84072'=> '应用未配置客服',
		'84073'=> '客服userid不在应用配置的客服列表中',
		'84074'=> '没有外部联系人权限',
		'84075'=> '不合法或过期的authcode',
		'84076'=> '缺失authcode',
		'84077'=> '订单价格过高，无法受理',
		'84078'=> '购买人数不正确',
		'84079'=> '价格策略不存在',
		'84080'=> '订单不存在',
		'84081'=> '存在未支付订单',
		'84082'=> '存在申请退款中的订单',
		'84083'=> '非服务人员',
		'84084'=> '非跟进用户',
		'84085'=> '应用已下架',
		'84086'=> '订单人数超过可购买最大人数',
		'84087'=> '打开订单支付前禁止关闭订单',
		'84088'=> '禁止关闭已支付的订单',
		'84089'=> '订单已支付',
		'84090'=> '缺失user_ticket',
		'84091'=> '订单价格不可低于下限',
		'84092'=> '无法发起代下单操作',
		'84093'=> '代理关系已占用，无法代下单',
		'84094'=> '该应用未配置代理分润规则，请先联系应用服务商处理',
		'84095'=> '免费试用版，无法扩容',
		'84096'=> '免费试用版，无法续期',
		'84097'=> '当前企业有未处理订单',
		'84098'=> '固定总量，无法扩容',
		'84099'=> '非购买状态，无法扩容',
		'84100'=> '未购买过此应用，无法续期',
		'84101'=> '企业已试用付费版本，无法全新购买',
		'84102'=> '企业当前应用状态已过期，无法扩容',
		'84103'=> '仅可修改未支付订单',
		'84104'=> '订单已支付，无法修改',
		'84105'=> '订单已被取消，无法修改',
		'84106'=> '企业含有该应用的待支付订单，无法代下单',
		'84107'=> '企业含有该应用的退款中订单，无法代下单',
		'84108'=> '企业含有该应用的待生效订单，无法代下单',
		'84109'=> '订单定价不能未0',
		'84110'=> '新安装应用不在试用状态，无法升级为付费版',
		'84111'=> '无足够可用优惠券',
		'84112'=> '无法关闭未支付订单',
		'84113'=> '无付费信息',
		'84114'=> '虚拟版本不支持下单',
		'84115'=> '虚拟版本不支持扩容',
		'84116'=> '虚拟版本不支持续期',
		'84117'=> '在虚拟正式版期内不能扩容',
		'84118'=> '虚拟正式版期内不能变更版本',
		'84119'=> '当前企业未报备，无法进行代下单',
		'84120'=> '当前应用版本已删除',
		'84121'=> '应用版本已删除，无法扩容',
		'84122'=> '应用版本已删除，无法续期',
		'84123'=> '非虚拟版本，无法升级',
		'84124'=> '非行业方案订单，不能添加部分应用版本的订单',
		'84125'=> '购买人数不能少于最少购买人数',
		'84126'=> '购买人数不能多于最大购买人数',
		'84127'=> '无应用管理权限',
		'84128'=> '无该行业方案下全部应用的管理权限',
		'84129'=> '付费策略已被删除，无法下单',
		'84130'=> '订单生效时间不合法',
		'84200'=> '文件转译解析错误	只支持utf8文件转译，可能是不支持的文件类型或者格式',
		'85002'=> '包含不合法的词语',
		'85004'=> '每企业每个月设置的可信域名不可超过20个',
		'85005'=> '可信域名未通过所有权校验',
		'86001'=> '参数 chatid 不合法',
		'86003'=> '参数 chatid 不存在',
		'86004'=> '参数 群名不合法',
		'86005'=> '参数 群主不合法',
		'86006'=> '群成员数过多或过少',
		'86007'=> '不合法的群成员',
		'86008'=> '非法操作非自己创建的群',
		'86101'=> '仅群主才有操作权限',
		'86201'=> '参数 需要chatid',
		'86202'=> '参数 需要群名',
		'86203'=> '参数 需要群主',
		'86204'=> '参数 需要群成员',
		'86205'=> '参数 字符串chatid过长',
		'86206'=> '参数 数字chatid过大',
		'86207'=> '群主不在群成员列表',
		'86215'=> '会话ID已经存在',
		'86216'=> '存在非法会话成员ID',
		'86217'=> '会话发送者不在会话成员列表中	会话的发送者，必须是会话的成员列表之一',
		'86220'=> '指定的会话参数不合法',
		'86224'=> '不是受限群，不允许使用该接口',
		'90001'=> '未认证摇一摇周边',
		'90002'=> '缺少摇一摇周边ticket参数',
		'90003'=> '摇一摇周边ticket参数不合法',
		'90100'=> '非法的对外属性类型',
		'90101'=> '对外属性：文本类型长度不合法	文本长度不可超过12个UTF8字符',
		'90102'=> '对外属性：网页类型标题长度不合法	标题长度不可超过12个UTF8字符',
		'90103'=> '对外属性：网页url不合法',
		'90104'=> '对外属性：小程序类型标题长度不合法	标题长度不可超过12个UTF8字符',
		'90105'=> '对外属性：小程序类型pagepath不合法',
		'90106'=> '对外属性：请求参数不合法',
		'90200'=> '缺少小程序appid参数',
		'90201'=> '小程序通知的content_item个数超过限制	item个数不能超过10个',
		'90202'=> '小程序通知中的key长度不合法	不能为空或超过10个汉字',
		'90203'=> '小程序通知中的value长度不合法	不能为空或超过30个汉字',
		'90204'=> '小程序通知中的page参数不合法',
		'90206'=> '小程序未关联到企业中',
		'90207'=> '不合法的小程序appid',
		'90208'=> '小程序appid不匹配',
		'90300'=> 'orderid 不合法',
		'90302'=> '付费应用已过期',
		'90303'=> '付费应用超过最大使用人数',
		'90304'=> '订单中心服务异常，请稍后重试',
		'90305'=> '参数错误，errmsg中有提示具体哪个参数有问题',
		'90306'=> '商户设置不合法，详情请见errmsg',
		'90307'=> '登录态过期',
		'90308'=> '在开启IP鉴权的前提下，识别为无效的请求IP',
		'90309'=> '订单已经存在，请勿重复下单',
		'90310'=> '找不到订单',
		'90311'=> '关单失败, 可能原因：该单并没被拉起支付页面; 已经关单；已经支付；渠道失败；单处于保护状态；等等',
		'90312'=> '退款请求失败, 详情请看errmsg',
		'90313'=> '退款调用频率限制，超过规定的阈值',
		'90314'=> '订单状态错误，可能未支付，或者当前状态操作受限',
		'90315'=> '退款请求失败，主键冲突，请核实退款refund_id是否已使用',
		'90316'=> '退款原因编号不对',
		'90317'=> '尚未注册成为供应商',
		'90318'=> '参数nonce_str 为空或者重复，判定为重放攻击',
		'90319'=> '时间戳为空或者与系统时间间隔太大',
		'90320'=> '订单token无效',
		'90321'=> '订单token已过有效时间',
		'90322'=> '旧套件（包含多个应用的套件）不支持支付系统',
		'90323'=> '单价超过限额',
		'90324'=> '商品数量超过限额',
		'90325'=> '预支单已经存在',
		'90326'=> '预支单单号非法',
		'90327'=> '该预支单已经结算下单',
		'90328'=> '结算下单失败，详情请看errmsg',
		'90329'=> '该订单号已经被预支单占用',
		'90330'=> '创建供应商失败',
		'90331'=> '更新供应商失败',
		'90332'=> '还没签署合同',
		'90333'=> '创建合同失败',
		'90338'=> '已经过了可退款期限',
		'90339'=> '供应商主体名包含非法字符',
		'90340'=> '创建客户失败，可能信息真实性校验失败',
		'90341'=> '退款金额大于付款金额',
		'90342'=> '退款金额超过账户余额',
		'90343'=> '退款单号已经存在',
		'90344'=> '指定的付款渠道无效',
		'90345'=> '超过5w人民币不可指定微信支付渠道',
		'90346'=> '同一单的退款次数超过限制',
		'90347'=> '退款金额不可为0',
		'90348'=> '管理端没配置支付密钥',
		'90349'=> '记录数量太大',
		'90350'=> '银行信息真实性校验失败',
		'90351'=> '应用状态异常',
		'90352'=> '延迟试用期天数超过限制',
		'90353'=> '预支单列表不可为空',
		'90354'=> '预支单列表数量超过限制',
		'90355'=> '关联有退款预支单，不可删除',
		'90356'=> '不能0金额下单',
		'90357'=> '代下单必须指定支付渠道',
		'90358'=> '预支单或代下单，不支持部分退款',
		'90359'=> '预支单与下单者企业不匹配',
		'90456'=> '必须指定组织者',
		'90457'=> '日历ID异常',
		'90458'=> '日历ID列表不能为空',
		'90459'=> '日历已删除',
		'90460'=> '日程已删除',
		'90461'=> '日程ID异常',
		'90462'=> '日程ID列表不能为空',
		'90463'=> '不能变更组织者',
		'90464'=> '参与者数量超过限制',
		'90465'=> '不支持的重复类型',
		'90466'=> '不能操作别的应用创建的日历/日程',
		'90467'=> '星期参数异常',
		'90468'=> '不能变更组织者',
		'90469'=> '每页大小超过限制',
		'90470'=> '页数异常',
		'90471'=> '提醒时间异常',
		'90472'=> '没有日历/日程操作权限',
		'90473'=> '颜色参数异常',
		'90474'=> '组织者不能与参与者重叠',
		'90475'=> '不是组织者的日历',
		'91040'=> '获取ticket的类型无效',
		'93004'=> '机器人被停用',
		'94000'=> '应用未开启工作台自定义模式	请在管理端后台应用详情里面开启自定义工作台模式',
		'94001'=> '不合法的type类型',
		'94002'=> '缺少keydata字段',
		'94003'=> 'keydata的items列表长度超出限制',
		'94005'=> '缺少list字段',
		'94006'=> 'list的items列表长度超出限制',
		'94007'=> '缺少webview字段',
		'94008'=> '应用未设置自定义工作台模版类型',
		'301002'=> '无权限操作指定的应用',
		'301005'=> '不允许删除创建者	创建者不允许从通讯录中删除。如果需要删除该成员，需要先在WEB管理端转移创建者身份。',
		'301012'=> '参数 position 不合法	长度不允许超过128个字符',
		'301013'=> '参数 telephone 不合法	telephone必须由1-32位的纯数字或’-‘号组成。',
		'301014'=> '参数 english_name 不合法	参数如果有传递，不允许为空字符串，同时不能超过64字节，只能是由字母、数字、点(.)、减号(-)、空格或下划线(_)组成',
		'301015'=> '参数 mediaid 不合法	请检查 mediaid 来源，应该通过上传临时素材的图片类型获得mediaid',
		'301016'=> '上传语音文件不符合系统要求	语音文件的系统限制，参考上传的媒体文件限制',
		'301017'=> '上传语音文件仅支持AMR格式	语音文件的系统限制，参考上传的媒体文件限制',
		'301021'=> '参数 userid 无效	至少有一个userid不存在于通讯录中',
		'301022'=> '获取打卡数据失败	系统失败，可重试处理',
		'301023'=> 'useridlist非法或超过限额	列表数量不能为0且不超过100',
		'301024'=> '获取打卡记录时间间隔超限	保证开始时间大于0 且结束时间大于 0 且结束时间大于开始时间，且间隔少于一个月',
		'301025'=> '审批开放接口参数错误	请参考参数说明正确填写',
		'301036'=> '不允许更新该用户的userid',
		'302003'=> '批量导入任务的文件中userid有重复',
		'302004'=> '组织架构不合法（1不是一棵树，2 多个一样的partyid，3 partyid空，4 partyid name 空，5 同一个父节点下有两个子节点 部门名字一样 可能是以上情况，请一一排查）',
		'302005'=> '批量导入系统失败，请重新尝试导入',
		'302006'=> '批量导入任务的文件中partyid有重复',
		'302007'=> '批量导入任务的文件中，同一个部门下有两个子部门名字一样',
		'200000'=> '2	CorpId参数无效	指定的CorpId不存在',
		'600001'=> '不合法的sn	sn可能尚未进行登记',
		'600002'=> '设备已注册	可能设备已经建立过长连接',
		'600003'=> '不合法的硬件activecode',
		'600004'=> '该硬件尚未授权任何企业',
		'600005'=> '硬件Secret无效',
		'600007'=> '缺少硬件sn',
		'600008'=> '缺少nonce参数',
		'600009'=> '缺少timestamp参数',
		'600010'=> '缺少signature参数',
		'600011'=> '签名校验失败',
		'600012'=> '长连接已经注册过设备',
		'600013'=> '缺少activecode参数',
		'600014'=> '设备未网络注册',
		'600015'=> '缺少secret参数',
		'600016'=> '设备未激活',
		'600018'=> '无效的起始结束时间',
		'600020'=> '设备未登录',
		'600021'=> '设备sn已存在',
		'600023'=> '时间戳已失效',
		'600024'=> '固件大小超过5M',
		'600025'=> '固件名为空或者超过20字节',
		'600026'=> '固件信息不存在',
		'600027'=> '非法的固件参数',
		'600028'=> '固件版本已存在',
		'600029'=> '非法的固件版本',
		'600030'=> '缺少固件版本参数',
		'600031'=> '硬件固件不允许升级',
		'600032'=> '无法解析硬件二维码',
		'600033'=> '设备型号id冲突',
		'600034'=> '指纹数据大小超过限制',
		'600035'=> '人脸数据大小超过限制',
		'600036'=> '设备sn冲突',
		'600037'=> '缺失设备型号id',
		'600038'=> '设备型号不存在',
		'600039'=> '不支持的设备类型',
		'600040'=> '打印任务id不存在',
		'600041'=> '无效的offset或limit参数值',
		'600042'=> '无效的设备型号id',
		'600043'=> '门禁规则未设置',
		'600044'=> '门禁规则不合法',
		'600045'=> '设备已订阅企业信息',
		'610001'=> '永久二维码超过每个员工5000的限制',
		'610003'=> 'scene参数不合法	有效的scene长度为1~64字符，由英文字母、数字、中划线、下划线以及点号构成',
		'610004'=> 'userid不在客户联系配置的使用范围内	请在管理端后台 客户联系->配置->配置使用范围配置该用户'
	];

	public static function getError($code)
	{
		return self::$errCode[$code]??null;
	}
}