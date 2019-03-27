import login from '@/views/login'
import page404 from '@/views/error-page/404.vue'

const layout = () => import(/* webpackChunkName: "group-index" */ '@/views/layout')

// 错误页面路由
export const errorRouterMap = [
  {
    path: '/403',
    meta: {
      title: '403-权限不足'
    },
    name: 'error-403',
    component: () => import('@/views/error-page/403.vue')
  },
  {
    path: '/500',
    meta: {
      title: '500-服务端错误'
    },
    name: 'error-500',
    component: () => import('@/views/error-page/500.vue')
  },
  { path: '/*', name: '404', hidden: true, component: page404 }
]

/**
* hidden: true                   如果hidden为true则不在左侧菜单栏展示，默认为false
* name:'router-name'             路由名称，必须填写
* meta : {
    title: 'title'               对应路由在左侧菜单栏的标题名称
    icon: 'icon-class'             对应路由在左侧菜单栏的图标样式，样式使用iconfont图标库，见assest/iconfont文件夹
  }
  children 下要显示的只有一个 则不会显示二级菜单 只显示该菜单 此时建议上级meta的title为''
**/
export const asyncRouterMap = [
  {
    path: '/',
    name: 'home',
    redirect: '/welcome',
    hidden: true,
    meta: { title: '', icon: 'android-home' },
    component: layout,
    children: [
      { path: 'welcome', name: 'welcome', meta: { title: '欢迎页', icon: 'ios-home' }, component: () => import(/* webpackChunkName: "group-index" */'@/views/home') }
    ]
  },
  {
    path: '/operate',
    name: 'operate',
    redirect: '/operate/home',
    meta: { title: '运营', icon: 'ios-contrast' },
    component: layout,
    children: [
      { path: 'home', name: 'home_index', meta: { title: '运营首页', icon: 'ios-home' }, component: () => import(/* webpackChunkName: "group-index" */'@/views/operate/home') },
      { path: 'users', meta: { title: '用户查询', keepAlive: true, icon: 'md-people' }, name: 'users_index', component: () => import('@/views/operate/users') },
      // { path: 'my-item', meta: { title: '道具查询', keepAlive: true, icon: 'social-codepen' }, name: 'my_item', component: () => import('@/views/operate/my-item') },
      // { path: 'shop-list', meta: { title: '商城列表', keepAlive: true, icon: 'ios-baseball' }, name: 'shop_list', component: () => import('@/views/operate/shop-list') },
      { path: 'gold-logs', meta: { title: '金币日志', keepAlive: true, icon: 'ios-cash' }, name: 'gold_logs', component: () => import('@/views/operate/gold-logs') },
      { path: 'game-logs', meta: { title: '游戏日志', keepAlive: true, icon: 'ios-game-controller-b' }, name: 'game_logs', component: () => import('@/views/operate/game-logs') },
      // { path: 'item-record', meta: { title: '增加道具', keepAlive: true, icon: 'ios-baseball' }, name: 'item_record', component: () => import('@/views/operate/item-record') },
      { path: 'gold-adjustment', meta: { title: '调整金币', keepAlive: true, icon: 'logo-bitcoin' }, name: 'gold_adjustment', component: () => import('@/views/operate/gold-adjustment') },
      { path: 'bank-gold-adjustment', meta: { title: '调整银行', keepAlive: true, icon: 'logo-bitcoin' }, name: 'bank_gold_adjustment', component: () => import('@/views/operate/bank-gold-adjustment') },
      { path: 'account-blocking', meta: { title: '封锁账号', keepAlive: true, icon: 'ios-closed-captioning' }, name: 'account_blocking', component: () => import('@/views/operate/account-blocking') },
      { path: 'game-message', meta: { title: '游戏公告', keepAlive: true, icon: 'ios-clipboard' }, name: 'game_message', component: () => import('@/views/operate/game-message') },
      { path: 'game-tax', meta: { title: '游戏税收', keepAlive: true, icon: 'logo-yen' }, name: 'game_tax', component: () => import('@/views/operate/game-tax') },
      { path: 'users-online', meta: { title: '在线玩家', keepAlive: true, icon: 'md-people' }, name: 'users_online', component: () => import('@/views/operate/users-online') },
      { path: 'data-report', meta: { title: '数据报表', keepAlive: true, icon: 'md-stats' }, name: 'data_report', component: () => import('@/views/operate/data-report') },
      { path: 'redpacket-list', meta: { title: '红包领取', keepAlive: true, icon: 'ios-egg' }, name: 'redpacket_list', component: () => import('@/views/operate/redpacket-list') },
      { path: 'redsyspacket', meta: { title: '红包发放', keepAlive: true, icon: 'ios-send' }, name: 'redsyspacket', component: () => import('@/views/operate/redsyspacket') },
      { path: 'rankuser-list', meta: { title: '排行玩家', keepAlive: true, icon: 'ios-stats' }, name: 'rankuser_list', component: () => import('@/views/operate/rankuser-list') }

    ]
  },
  {
    path: '/service',
    name: 'service',
    redirect: '/service/service-list',
    meta: { title: '客服', icon: 'md-outlet' },
    component: layout,
    children: [
      // { path: 'service-list', meta: { title: '客服反馈', keepAlive: true, icon: 'chatbox-working' }, name: 'service_list', component: () => import('@/views/service/service-list') },
      { path: 'report-logs', meta: { title: '举报记录', keepAlive: true, icon: 'ios-clipboard' }, name: 'report_logs', component: () => import('@/views/service/report-logs') },
      { path: 'service-chat-logs', meta: { title: '聊天记录', icon: 'ios-chatbubbles' }, name: 'service_chat_logs', component: () => import('@/views/service/service-chat-logs') },
      { path: 'suggestions', meta: { title: '意见反馈', icon: 'ios-chatbubbles' }, name: 'suggestions', component: () => import('@/views/service/suggestions') }

    ]
  },
  {
    path: '/pay',
    name: 'pay',
    redirect: '/pay/charge-orders',
    meta: { title: '支付', icon: 'md-card' },
    component: layout,
    children: [
      { path: 'charge-orders', meta: { title: '充值订单', keepAlive: true, icon: 'ios-list' }, name: 'charge_orders', component: () => import('@/views/pay/charge-orders') },
      { path: 'recharge-channel', meta: { title: '充值配置', keepAlive: true, icon: 'ios-cog' }, name: 'recharge_channel', component: () => import('@/views/pay/recharge-channel') },
      { path: 'exchange-orders', meta: { title: '提现订单', keepAlive: true, icon: 'ios-list' }, name: 'exchange_orders', component: () => import('@/views/pay/exchange-orders') },
      { path: 'exchange-channel', meta: { title: '提现配置', keepAlive: true, icon: 'ios-cog' }, name: 'exchange_channel', component: () => import('@/views/pay/exchange-channel') },
      { path: 'recharge-setting', meta: { title: '金额配置', keepAlive: true, icon: 'ios-cog' }, name: 'recharge-setting', component: () => import('@/views/pay/recharge-setting') },
      { path: 'post-man', meta: { title: 'PostURL', keepAlive: true, icon: 'ios-send' }, name: 'post_man', component: () => import('@/views/agent/post-man') }

    ]

  },
  {
    path: '/agent',
    name: 'agent',
    redirect: '/agent/promo-statics',
    meta: { title: '推广', icon: 'md-cube' },
    component: layout,
    children: [
      { path: 'promo-statics', meta: { title: '推广首页', icon: 'ios-home' }, name: 'promo_statics', component: () => import('@/views/agent/home') },
      { path: 'agent-list', meta: { title: '代理管理', keepAlive: true, icon: 'ios-list' }, name: 'agent_list', component: () => import('@/views/agent/agent-list') },
      { path: 'promo-url', meta: { title: '推广地址', keepAlive: true, icon: 'ios-navigate' }, name: 'promo_url', component: () => import('@/views/agent/promo-url') },
      { path: 'promo-list', meta: { title: '推广统计', keepAlive: true, icon: 'ios-analytics' }, name: 'promo_list', component: () => import('@/views/agent/promo-list') },
      { path: 'income-list', meta: { title: '收入统计', keepAlive: true, icon: 'md-grid' }, name: 'income_list', component: () => import('@/views/agent/income-list') },
      { path: 'income-detail-list', meta: { title: '收入明细', keepAlive: true, icon: 'ios-flask' }, name: 'income_detail_list', component: () => import('@/views/agent/income-detail-list') },
      { path: 'merchant-setting', meta: { title: '商人展示', keepAlive: true, icon: 'ios-contact' }, name: 'merchant_setting', component: () => import('@/views/agent/merchant-setting') },
      { path: 'settle-record', meta: { title: '提现审核', keepAlive: true, icon: 'md-list' }, name: 'settle_record', component: () => import('@/views/agent/settle-record') },
      // { path: 'transfer', meta: { title: '转账操作', icon: 'arrow-swap' }, name: 'transfer', component: () => import('@/views/agent/transfer') },
      { path: 'transfer-record', meta: { title: '转账记录', keepAlive: true, icon: 'ios-list-box' }, name: 'transfer_record', component: () => import('@/views/agent/transfer-record') },
      { path: 'buy-record', meta: { title: '进分记录', keepAlive: true, icon: 'ios-paper' }, name: 'buy_record', component: () => import('@/views/agent/buy-record') },
      // { path: 'settle-pass', meta: { title: '结算密码', icon: 'lock-combination' }, name: 'settle_pass', component: () => import('@/views/agent/settle-pass') },
      // { path: 'settlement', meta: { title: '提交结算', icon: 'arrow-up-a' }, name: 'settlement', component: () => import('@/views/agent/settlement') }
      { path: 'wj-promolist', meta: { title: '全民推广', keepAlive: true, icon: 'ios-aperture' }, name: 'wj_promoList', component: () => import('@/views/agent/wj-promolist') },
      { path: 'player-transfer', meta: { title: '收分记录', keepAlive: true, icon: 'ios-list-box' }, name: 'player_transfer', component: () => import('@/views/agent/player-transfer') },
      { path: 'agent-transfer', meta: { title: '下分记录', keepAlive: true, icon: 'md-list-box' }, name: 'agent_transfer', component: () => import('@/views/agent/agent-transfer') }

    ]
  },
  {
    path: '/game',
    name: 'game',
    redirect: '/game/game-room-setting',
    meta: { title: '游戏配置', icon: 'ios-game-controller-b' },
    component: layout,
    children: [
      { path: 'game-room-setting', meta: { title: '游戏房间', keepAlive: true, icon: 'logo-xbox' }, name: 'game_room_setting', component: () => import('@/views/game/game-room-setting') },
      { path: 'exchange-setting', meta: { title: '提现设置', keepAlive: true, icon: 'md-settings' }, name: 'exchange_setting', component: () => import('@/views/game/exchange-setting') },
      { path: 'redpacket-setting', meta: { title: '红包设置', keepAlive: true, icon: 'md-settings' }, name: 'redpacket_setting', component: () => import('@/views/game/redpacket-setting') },
      { path: 'ranklist-setting', meta: { title: '排行奖励', keepAlive: true, icon: 'ios-trophy' }, name: 'ranklist_setting', component: () => import('@/views/game/ranklist-setting') },
      { path: 'promo-setting', meta: { title: '推广设置', keepAlive: true, icon: 'md-settings' }, name: 'promo_setting', component: () => import('@/views/game/promo-setting') },
      { path: 'word-filter', meta: { title: '字符过滤', keepAlive: true, icon: 'logo-wordpress' }, name: 'word_filter', component: () => import('@/views/game/word-filter') },
      { path: 'limit-user', meta: { title: '提现忽略', keepAlive: true, icon: 'logo-pinterest' }, name: 'limit_user', component: () => import('@/views/game/limit-user') },
      { path: 'award-setting', meta: { title: '奖励配置', keepAlive: true, icon: 'ios-trophy' }, name: 'award_setting', component: () => import('@/views/game/award-setting') },
      { path: 'robot-setting', meta: { title: '机器人配置', keepAlive: true, icon: 'md-ionitron' }, name: 'robot_setting', component: () => import('@/views/game/robot-setting') },
      { path: 'register-setting', meta: { title: '注册赠送配置', keepAlive: true, icon: 'ios-rose' }, name: 'register_setting', component: () => import('@/views/game/register-setting') },
      { path: 'report-setting', meta: { title: '举报有奖配置', keepAlive: true, icon: 'ios-ribbon' }, name: 'report_setting', component: () => import('@/views/game/report-setting') },
      { path: 'yrbw-setting', meta: { title: '月入百万配置', keepAlive: true, icon: 'ios-speedometer' }, name: 'yrbw_setting', component: () => import('@/views/game/yrbw-setting') },
      { path: 'api-logs', meta: { title: '接口日志', keepAlive: true, icon: 'ios-list-box' }, name: 'api_logs', component: () => import('@/views/game/api-logs') },
      { path: 'agent-package', meta: { title: '分包管理', keepAlive: true, icon: 'md-list' }, name: 'agent_package', component: () => import('@/views/game/agent-package') }
    ]
  },
  {
    path: '/risk',
    name: 'risk',
    redirect: '/risk/risk-config',
    meta: { title: '风控', icon: 'ios-notifications' },
    component: layout,
    children: [
      { path: 'risk-config', meta: { title: '风控配置', icon: 'ios-options' }, name: 'risk_config', component: () => import('@/views/risk/config') },
      { path: 'risk-records', meta: { title: '风控记录', icon: 'ios-recording' }, name: 'risk_records', component: () => import('@/views/risk/record') }
    ]
  },
  {
    path: '/system',
    name: 'system',
    redirect: '/system/gm-account-list',
    meta: { title: '系统', icon: 'ios-desktop' },
    component: layout,
    children: [
      { path: 'account-setting', meta: { title: '账号设置', icon: 'ios-body' }, name: 'account_setting', component: () => import('@/views/system/account-setting') },
      { path: 'login-logs', meta: { title: '登陆日志', keepAlive: true, icon: 'md-recording' }, name: 'login_logs', component: () => import('@/views/system/login-logs') },
      { path: 'operate-logs', meta: { title: '操作日志', keepAlive: true, icon: 'md-disc' }, name: 'operate_logs', component: () => import('@/views/system/operate-logs') },
      { path: 'gm-account-list', meta: { title: '管理账号', keepAlive: true, icon: 'ios-man' }, name: 'gm_account_list', component: () => import('@/views/system/gm-account-list') }

    ]
  }

]
/**
 * 登陆路由
 */
export const constantRouterMap = [
  { path: '/login', name: 'login', hidden: true, meta: { title: '系统登录' }, component: login }
  //   ...asyncRouterMap,
  //   ...errorRouterMap
]
