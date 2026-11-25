<?php
/**
 * Higer Footer — فوتر اختصاصی تشک هیگر | نسخه لوکس بدون بیلد (v2.2)
 * =====================================================================
 * اسنیپت PHP مستقل برای افزونه WPCode، طراحی‌شده با زبان بصری معماری،
 * سرمه‌ای نیمه‌شب و طلایی شامپاینی، کاملاً هماهنگ با:
 *   • Home Page.php
 *   • Shop Page.php
 *   • Single Product Page.php
 *
 * ─── نصب در WPCode (۲ دقیقه) ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل همین فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *  ۴. Save و Activate
 *  ۵. در Elementor Pro > Theme Builder > Footer ویجت‌های قبلی را حذف کرده
 *     و یک ویجت Shortcode با مقدار [higer_footer] قرار دهید.
 *     (اگر از المنتور استفاده نمی‌کنید، در بخش تنظیمات 'auto_inject' را true کنید.)
 *
 * ─── شورت‌کدها ───
 *  [higer_footer]                 نمایش کامل فوتر با حالت تمام‌عرض
 *  [higer_footer fullwidth="no"]  بدون کشیدگی تمام‌عرض
 *  [higer_footer cta="no"]        بدون بنر مشاوره بالای فوتر
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_footer_config' ) ) :
function higer_footer_config() {
	$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';
	$acct = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : rtrim( $home, '/' ) . '/my-account/';
	$cart = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : rtrim( $home, '/' ) . '/my-cart/';

	return array(
		/* --- هویت برند --- */
		'brand' => array(
			'name'        => 'تشک هیگر',
			'en_name'     => 'HIGER MATTRESS',
			'description' => 'فعالیت ما در صنعت تشک از سال ۱۳۸۷ آغاز شد و با ثبت رسمی برند هیگر، تولید تخصصی تشک‌های فنر متصل، فنر منفصل پاکتی، ریباند و فوم سنگین را بر پایه استانداردهای روز و دوام ماندگار ادامه می‌دهیم.',
			'home_url'    => $home,
			'use_wp_logo' => true,
			'logo_url'    => 'https://higermattress.ir/wp-content/uploads/2026/08/logo-600x343.webp',
		),

		/* --- اطلاعات فروشگاه و دفتر مرکزی --- */
		'store' => array(
			'phone'    => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'      => 'tel:+989111186485',
			'landline' => '۰۱۱-۳۲۲۵۴۹۹۲',
			'land_tel' => 'tel:+981132254992',
			'email'     => 'contact@higermattress.ir',
			'address'   => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی ۲۷، فروشگاه و دفتر مرکزی هیگر',
			'hours'     => 'همه‌روزه به‌جز روزهای تعطیل، ساعت ۹ الی ۲۱',
			/* پلاس‌کد گوگل‌مپ و مختصات شوروم برای دکمه‌های سبک مسیریابی (بدون بارگذاری iframe در همه صفحات) */
			'map_query' => 'GMVQ+6X Babol, Mazandaran Province, Iran',
			'lat'       => 36.543063,
			'lng'       => 52.689938,
			'map_url'   => '', // اختیاری: لینک دلخواه گوگل‌مپ؛ خالی = ساخت خودکار از map_query
			'neshan_url'=> '', // اختیاری: لینک دلخواه نشان؛ خالی = ساخت خودکار از lat/lng
		),

		/* --- رفتار هوشمند فوتر --- */
		'behavior' => array(
			'auto_inject'              => false, // true = تزریق خودکار بدون المنتور (در هوک wp_footer)
			'show_cta_banner'          => true,  // بنر مشاوره بالای فوتر در صفحه اصلی و برگه‌های عمومی
			'hide_cta_on_shop_product' => true,  // مخفی‌سازی خودکار بنر مشاوره در فروشگاه و محصول تکی (چون خودشان سکشن مشاوره دارند)
			'hide_cta_on_pages'        => array( 'about', 'contact-us' ), // نامک برگه‌هایی که خودشان بخش تماس/مشاوره دارند (About Page.php و Contact Page.php)
			'show_pillars'             => true,  // نوار ۴ اصل اصالت و استاندارد هیگر
			'show_back_to_top'         => true,  // دکمه بازگشت نرم به بالای صفحه
		),

		/* --- بنر دعوت به مشاوره بالای فوتر --- */
		'cta' => array(
			'kicker'   => 'راهنمای اختصاصی انتخاب تشک',
			'title_a'  => 'انتخاب تشک مناسب، ',
			'title_b'  => 'سرمایه‌گذاری روی کیفیت خواب شماست',
			'subtitle' => 'با پاسخ به ۵ پرسش کوتاه در تشک‌سنج هوشمند، گزینه‌های دقیق متناسب با وزن و حالت خوابتان را ببینید یا مستقیماً با کارشناسان هیگر گفتگو کنید.',
			'btn1'     => 'شروع تشک‌سنج هوشمند',
			'btn1_url' => rtrim( $home, '/' ) . '/#hg-finder',
			'btn2'     => 'مشاوره تلفنی',
		),

		/* --- ۴ ستون ارزش و استاندارد بالای بدنه فوتر --- */
		'pillars' => array(
			array(
				'icon'  => 'award',
				'title' => 'تجربه از سال ۱۳۸۷',
				'sub'   => 'شناخت عمیق ارگونومی و مهندسی خواب',
			),
			array(
				'icon'  => 'layers',
				'title' => '۴ فناوری هسته تشک',
				'sub'   => 'فنر متصل، منفصل، ریباند و فوم سنگین',
			),
			array(
				'icon'  => 'ruler',
				'title' => '۹ سایز + دوخت سفارشی',
				'sub'   => 'از نوزاد تا سوپرکینگ و ابعاد دلخواه',
			),
			array(
				'icon'  => 'shield',
				'title' => 'ضمانت معتبر فاکتوری',
				'sub'   => 'پشتیبانی مستقیم دفتر مرکزی هیگر',
			),
		),

		/* --- ستون ۲: مجموعه محصولات --- */
		'col_products' => array(
			'title' => 'مجموعه محصولات',
			'links' => array(
				array( 'label' => 'همه مدل‌های فروشگاه',      'url' => $shop ),
				array( 'label' => 'تشک فنر متصل (Bonnell)',   'url' => rtrim( $home, '/' ) . '/product-category/mattress/spring/bonnell-spring/' ),
				array( 'label' => 'تشک فنر منفصل (Pocket)',   'url' => rtrim( $home, '/' ) . '/product-category/mattress/spring/pocket-spring/' ),
				array( 'label' => 'تشک ریباند طبی',           'url' => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/rebound/' ),
				array( 'label' => 'تشک فوم سنگین',            'url' => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/high-density-foam/' ),
				array( 'label' => 'تاپر و محافظ تشک',         'url' => rtrim( $home, '/' ) . '/product-category/accessories/' ),
			),
		),

		/* --- ستون ۳: راهنمای خرید و خدمات --- */
		'col_quick' => array(
			'title' => 'خدمات و دسترسی سریع',
			'links' => array(
				array( 'label' => 'تشک‌سنج هوشمند هیگر', 'url' => rtrim( $home, '/' ) . '/#hg-finder' ),
				array( 'label' => 'درباره داستان هیگر',  'url' => rtrim( $home, '/' ) . '/about/' ),
				array( 'label' => 'تماس با دفتر مرکزی',  'url' => rtrim( $home, '/' ) . '/contact-us/' ),
				array( 'label' => 'سؤالات متداول خرید',  'url' => rtrim( $home, '/' ) . '/#hg-faq' ),
				array( 'label' => 'حساب کاربری من',      'url' => $acct ),
				array( 'label' => 'سبد خرید و سفارش',    'url' => $cart ),
			),
		),

		/* --- شبکه‌های اجتماعی (هر موردی که لینک داشته باشد خودکار نمایش می‌یابد) --- */
		'socials' => array(
			/* واتساپ: wa.me/شماره با کد کشور (بدون صفر و +) | تلگرام: t.me/+شماره یا t.me/نام‌کاربری */
			array( 'key' => 'whatsapp',  'label' => 'واتساپ',     'handle' => '۰۹۱۱۱۱۸۶۴۸۵',   'url' => 'https://wa.me/989111186485?text=' . rawurlencode( 'سلام، از سایت تشک هیگر پیام می‌دهم.' ) ),
			array( 'key' => 'telegram',  'label' => 'تلگرام',     'handle' => '۰۹۱۱۱۱۸۶۴۸۵',   'url' => 'https://t.me/+989111186485' ),
			array( 'key' => 'instagram', 'label' => 'اینستاگرام', 'handle' => 'higer.mattress', 'url' => 'https://www.instagram.com/higer.mattress/' ),
		),

		/* --- مجوزهای رسمی (کد HTML اینماد یا ساماندهی را اینجا قرار دهید) --- */
		'trust' => array(
			'enamad_html'    => '', // کد HTML اینماد
			'samandehi_html' => '', // کد HTML ساماندهی
		),

		/* --- کپی‌رایت و لینک‌های پایانی --- */
		'copyright'    => 'تمامی حقوق مادی و معنوی این وب‌سایت متعلق به تشک هیگر است.',
		'year_fa'      => '۱۴۰۵',
		'policy_label' => 'قوانین و حریم خصوصی',
		'policy_url'   => rtrim( $home, '/' ) . '/terms-and-privacy/',
	);
}
endif;

/* ============================================================
   بخش ۲ — آیکون‌ها و توابع کمکی
   ============================================================ */

if ( ! function_exists( 'higer_footer_icon' ) ) {
	function higer_footer_icon( $name, $size = 16 ) {
		$icons = array(
			'phone'     => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'pin'       => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
			'navigate'  => '<polygon points="3 11 22 2 13 21 11 13 3 11"/>',
			'clock'     => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
			'mail'      => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
			'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/>',
			'ruler'     => '<path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/>',
			'layers'    => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
			'award'     => '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>',
			'gem'       => '<path d="M12 3l2.4 5.6L20 11l-5.6 2.4L12 19l-2.4-5.6L4 11l5.6-2.4L12 3z"/>',
			'arrow-l'   => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'up'        => '<path d="m18 15-6-6-6 6"/>',
			'instagram' => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
			'telegram'  => '<path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>',
			'whatsapp'  => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
		);
		$path = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
		return '<svg width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

if ( ! function_exists( 'higer_footer_logo_src' ) ) {
	function higer_footer_logo_src( $cfg ) {
		if ( ! empty( $cfg['brand']['use_wp_logo'] ) && function_exists( 'get_theme_mod' ) ) {
			$logo_id = (int) get_theme_mod( 'custom_logo' );
			if ( $logo_id ) {
				$img = wp_get_attachment_image_url( $logo_id, 'medium_large' );
				if ( ! $img ) {
					$img = wp_get_attachment_image_url( $logo_id, 'full' );
				}
				if ( $img ) {
					return $img;
				}
			}
		}
		return ! empty( $cfg['brand']['logo_url'] ) ? $cfg['brand']['logo_url'] : '';
	}
}

/* ============================================================
   بخش ۳ — استایل و اسکریپت لوکس فوتر (فقط یک‌بار چاپ می‌شود)
   ============================================================ */

if ( ! function_exists( 'higer_footer_assets' ) ) {
	function higer_footer_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		ob_start();
		?>
<style id="higer-footer-styles">
/* خنثی‌سازی فاصله‌های پیش‌فرض کانتینر فوتر المنتور */
[data-elementor-type="footer"],
.elementor-location-footer {
  margin: 0 !important;
  padding: 0 !important;
  background: #060d1a !important;
  border: 0 !important;
}
[data-elementor-type="footer"] .e-con,
.elementor-location-footer .e-con,
[data-elementor-type="footer"] .elementor-widget-container,
.elementor-location-footer .elementor-widget-container {
  padding: 0 !important;
  margin: 0 !important;
}

/* ================== فوتر معماری و لوکس تشک هیگر ================== */
.higer-footer {
  --hft-navy-950: #060d1a;
  --hft-navy-900: #0b182d;
  --hft-navy-800: #122643;
  --hft-gold-600: #c8892a;
  --hft-gold-500: #d9a13b;
  --hft-gold-400: #e7b95c;
  --hft-gold-300: #f3d98b;
  --hft-gold-200: #f8ead0;
  --hft-cream: #faf7ef;

  position: relative;
  overflow: hidden;
  display: block;
  font-family: "IRANSans", "Vazirmatn", "Segoe UI", Tahoma, sans-serif;
  direction: rtl;
  text-align: right;
  color: var(--hft-cream);
  font-size: 16px;
  line-height: 1.7;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  background:
    radial-gradient(960px 420px at 85% 0%, rgba(217, 161, 59, 0.11), transparent 62%),
    radial-gradient(840px 460px at 5% 100%, rgba(31, 62, 99, 0.26), transparent 60%),
    linear-gradient(180deg, #071122 0%, #09162b 52%, #050b16 100%);
}
.higer-footer *, .higer-footer *::before, .higer-footer *::after { box-sizing: border-box; }
.higer-footer :is(h2, h3, h4, p, ul, ol) { margin: 0; padding: 0; list-style: none; }
.higer-footer a { text-decoration: none !important; color: inherit; background: none; }
.higer-footer button {
  font: inherit; color: inherit; background: none; border: 0; cursor: pointer;
  padding: 0; margin: 0; box-shadow: none; text-transform: none;
}
.higer-footer svg { display: block; flex-shrink: 0; }

/* خط افق طلایی ظریف در مرز بالایی فوتر */
.higer-footer::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent 3%, rgba(243, 217, 139, 0.48) 50%, transparent 97%);
  z-index: 2;
}

/* بافت معماری ظریف هماهنگ با هیرو و سکشن‌های سرمه‌ای سایت */
.higer-footer .hft-ambient-grid {
  position: absolute;
  inset: 0;
  pointer-events: none;
  background-image:
    linear-gradient(rgba(243, 217, 139, 0.032) 1px, transparent 1px),
    linear-gradient(90deg, rgba(243, 217, 139, 0.032) 1px, transparent 1px);
  background-size: 48px 48px;
  mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), transparent 85%);
  -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), transparent 85%);
}

.higer-footer .hft-wrap {
  position: relative;
  z-index: 1;
  max-width: 1320px;
  margin-inline: auto;
  padding-inline: 16px;
}
@media (min-width: 640px) { .higer-footer .hft-wrap { padding-inline: 24px; } }

.higer-footer .hft-gold-text {
  background: linear-gradient(175deg, #f8ead0 8%, #e7b95c 35%, #d9a13b 55%, #b67b22 82%, #e7b95c 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

/* ================== ۱. بنر ادیتوریال مشاوره بالای فوتر ================== */
.higer-footer .hft-concierge-sec {
  padding-top: 48px;
}
.higer-footer .hft-concierge {
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  gap: 24px;
  padding: 28px 24px;
  border-radius: 26px;
  border: 1px solid rgba(243, 217, 139, 0.24);
  background:
    radial-gradient(520px 220px at 90% 0%, rgba(217, 161, 59, 0.18), transparent 70%),
    linear-gradient(155deg, rgba(16, 36, 62, 0.78), rgba(7, 15, 29, 0.88));
  box-shadow:
    0 24px 60px rgba(3, 8, 18, 0.5),
    inset 0 1px 0 rgba(255, 255, 255, 0.08);
}
@media (min-width: 960px) {
  .higer-footer .hft-concierge {
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 34px 40px;
  }
}
.higer-footer .hft-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 5px 14px;
  border-radius: 999px;
  border: 1px solid rgba(217, 161, 59, 0.42);
  background: rgba(7, 15, 29, 0.5);
  color: var(--hft-gold-300);
  font-size: 11px;
  font-weight: 800;
}
.higer-footer .hft-concierge-title {
  margin-top: 12px;
  font-size: 21px;
  font-weight: 900;
  line-height: 1.5;
  color: var(--hft-cream);
}
@media (min-width: 640px) { .higer-footer .hft-concierge-title { font-size: 26px; } }
.higer-footer .hft-concierge-sub {
  margin-top: 8px;
  max-width: 600px;
  font-size: 13px;
  line-height: 2;
  color: rgba(248, 234, 208, 0.78);
}
.higer-footer .hft-concierge-btns {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
}
.higer-footer a.hft-btn-gold {
  position: relative;
  overflow: hidden;
  display: inline-flex;
  align-items: center;
  gap: 9px;
  padding: 13px 24px;
  border-radius: 999px;
  background: linear-gradient(180deg, #ecc470 0%, #d9a13b 55%, #c8892a 100%);
  color: #10243e !important;
  font-size: 13px;
  font-weight: 900;
  box-shadow: 0 12px 28px rgba(217, 161, 59, 0.34), inset 0 1px 0 rgba(255, 255, 255, 0.75);
  transition: transform 0.24s ease, filter 0.24s ease;
}
.higer-footer a.hft-btn-gold:hover { transform: translateY(-2px); filter: brightness(1.04); }
.higer-footer a.hft-btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  padding: 12px 22px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.38);
  background: rgba(7, 15, 29, 0.35);
  color: var(--hft-gold-200) !important;
  font-size: 13px;
  font-weight: 800;
  transition: border-color 0.24s ease, background-color 0.24s ease;
}
.higer-footer a.hft-btn-outline:hover {
  border-color: rgba(243, 217, 139, 0.78);
  background: rgba(243, 217, 139, 0.09);
}

/* ================== ۲. نوار ۴ ستونه اصالت و استاندارد ================== */
.higer-footer .hft-pillars-wrap {
  margin-top: 36px;
  border-block: 1px solid rgba(243, 217, 139, 0.12);
  background: rgba(5, 11, 22, 0.36);
}
.higer-footer .hft-pillars {
  display: grid;
  grid-template-columns: 1fr;
}
@media (min-width: 640px) {
  .higer-footer .hft-pillars { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (min-width: 1024px) {
  .higer-footer .hft-pillars { grid-template-columns: repeat(4, minmax(0, 1fr)); }
}
.higer-footer .hft-pillar {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 20px 16px;
  border-bottom: 1px solid rgba(243, 217, 139, 0.08);
}
@media (min-width: 1024px) {
  .higer-footer .hft-pillar {
    border-bottom: 0;
    padding: 22px 20px;
  }
  .higer-footer .hft-pillar + .hft-pillar {
    border-right: 1px solid rgba(243, 217, 139, 0.11);
  }
}
.higer-footer .hft-pillar-ring {
  width: 42px;
  height: 42px;
  border-radius: 13px;
  border: 1px solid rgba(243, 217, 139, 0.26);
  background: radial-gradient(circle at 30% 25%, rgba(236, 196, 112, 0.2), rgba(7, 15, 29, 0.5));
  color: var(--hft-gold-300);
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.higer-footer .hft-pillar b {
  display: block;
  font-size: 13px;
  font-weight: 900;
  color: var(--hft-cream);
}
.higer-footer .hft-pillar span {
  display: block;
  margin-top: 2px;
  font-size: 11px;
  color: rgba(250, 247, 239, 0.62);
}

/* ================== ۳. بدنه اصلی نامتقارن ۴ ستونه ================== */
.higer-footer .hft-main {
  padding-block: 52px 44px;
  display: grid;
  gap: 36px;
  grid-template-columns: 1fr;
}
@media (min-width: 640px) {
  .higer-footer .hft-main { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (min-width: 1024px) {
  .higer-footer .hft-main {
    grid-template-columns: 1.4fr 0.85fr 0.85fr 1.25fr;
    gap: 40px;
    padding-block: 60px 52px;
  }
}

/* ستون ۱: هویت برند و کارت خطوط مستقیم */
.higer-footer a.hft-brand {
  display: inline-flex;
  align-items: center;
  gap: 12px;
}
.higer-footer .hft-logo {
  height: 62px;
  width: auto;
  max-width: 225px;
  object-fit: contain;
  display: block;
}
.higer-footer .hft-crest {
  display: inline-flex;
  align-items: center;
  gap: 11px;
}
.higer-footer .hft-crest-mark {
  width: 40px;
  height: 40px;
  border-radius: 12px;
  border: 1px solid rgba(243, 217, 139, 0.4);
  background: radial-gradient(circle at 30% 25%, rgba(236, 196, 112, 0.25), rgba(7, 15, 29, 0.7));
  display: grid;
  place-items: center;
  color: var(--hft-gold-300);
  font-weight: 900;
  font-size: 18px;
}
.higer-footer .hft-crest-copy b {
  display: block;
  font-size: 17px;
  font-weight: 900;
  color: var(--hft-cream);
  line-height: 1.25;
}
.higer-footer .hft-crest-copy small {
  display: block;
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: 0.16em;
  color: var(--hft-gold-300);
  opacity: 0.85;
}
.higer-footer .hft-desc {
  margin-top: 16px;
  font-size: 12.5px;
  line-height: 2.05;
  color: rgba(250, 247, 239, 0.72);
}

/* کارت خطوط تماس مستقیم زیر معرفی برند */
.higer-footer .hft-hotline {
  margin-top: 20px;
  padding: 14px 16px;
  border-radius: 18px;
  border: 1px solid rgba(243, 217, 139, 0.18);
  background: rgba(5, 11, 22, 0.48);
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.higer-footer .hft-hotline-label {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 700;
  color: var(--hft-gold-300);
}
.higer-footer .hft-hotline-nums {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px 16px;
}
.higer-footer a.hft-hotline-num {
  font-size: 15px;
  font-weight: 900;
  color: var(--hft-cream);
  direction: ltr;
  unicode-bidi: embed;
  letter-spacing: 0.02em;
  transition: color 0.2s;
}
.higer-footer a.hft-hotline-num:hover { color: var(--hft-gold-300); }
.higer-footer .hft-hotline-div {
  width: 1px;
  height: 16px;
  background: rgba(243, 217, 139, 0.22);
}

.higer-footer .hft-social-cap {
  display: block;
  margin-top: 18px;
  font-size: 11px;
  font-weight: 700;
  color: var(--hft-gold-300);
  opacity: 0.85;
}
.higer-footer .hft-socials {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 10px;
}
.higer-footer a.hft-social {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 7px 14px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.22);
  background: rgba(255, 255, 255, 0.03);
  font-size: 11.5px;
  font-weight: 700;
  color: var(--hft-gold-200);
  transition: all 0.22s ease;
}
.higer-footer a.hft-social:hover {
  border-color: var(--hft-gold-400);
  background: rgba(217, 161, 59, 0.14);
  transform: translateY(-2px);
}

/* تیتر ستون‌ها با خط طلایی مینیمال */
.higer-footer .hft-col-head {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
  font-size: 13.5px;
  font-weight: 900;
  color: var(--hft-gold-200);
  letter-spacing: 0.01em;
}
.higer-footer .hft-col-head::before {
  content: "";
  width: 18px;
  height: 1.5px;
  border-radius: 99px;
  background: linear-gradient(90deg, var(--hft-gold-400), transparent);
}

/* لینک‌های ادیتوریال با خط تیره متحرک طلایی */
.higer-footer .hft-links {
  display: flex;
  flex-direction: column;
  gap: 11px;
}
.higer-footer .hft-links a {
  display: inline-flex;
  align-items: center;
  gap: 0;
  font-size: 12.5px;
  font-weight: 600;
  color: rgba(250, 247, 239, 0.74);
  transition: color 0.22s ease;
}
.higer-footer .hft-links a::before {
  content: "";
  display: inline-block;
  width: 0;
  height: 1.5px;
  margin-left: 0;
  border-radius: 99px;
  background: var(--hft-gold-400);
  transition: width 0.24s cubic-bezier(0.22, 1, 0.36, 1), margin-left 0.24s ease;
}
.higer-footer .hft-links a:hover {
  color: var(--hft-gold-200);
}
.higer-footer .hft-links a:hover::before {
  width: 12px;
  margin-left: 8px;
}

/* ستون ۴: شوروم و مجوزهای رسمی */
.higer-footer .hft-showroom-card {
  padding: 16px;
  border-radius: 18px;
  border: 1px solid rgba(243, 217, 139, 0.15);
  background: rgba(5, 11, 22, 0.42);
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.higer-footer .hft-info-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 12px;
  line-height: 1.85;
  color: rgba(250, 247, 239, 0.8);
}
.higer-footer .hft-info-ico {
  color: var(--hft-gold-400);
  margin-top: 3px;
}
.higer-footer .hft-map-links {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  padding-top: 10px;
  border-top: 1px solid rgba(243, 217, 139, 0.12);
}
.higer-footer a.hft-map-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.24);
  background: rgba(217, 161, 59, 0.08);
  font-size: 11px;
  font-weight: 800;
  color: var(--hft-gold-200);
  transition: border-color 0.2s ease, background-color 0.2s ease, transform 0.2s ease;
}
.higer-footer a.hft-map-link:hover {
  border-color: var(--hft-gold-400);
  background: rgba(217, 161, 59, 0.18);
  color: var(--hft-gold-300);
  transform: translateY(-1px);
}

/* قاب نمادهای اعتماد و مجوزها */
.higer-footer .hft-seals {
  margin-top: 14px;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.higer-footer .hft-seal-box {
  min-height: 78px;
  padding: 10px;
  border-radius: 16px;
  border: 1px solid rgba(243, 217, 139, 0.2);
  background: rgba(255, 255, 255, 0.96);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}
.higer-footer .hft-seal-box img { max-height: 62px; width: auto; display: block; }

.higer-footer .hft-seal-luxury {
  padding: 12px;
  border-radius: 16px;
  border: 1px solid rgba(243, 217, 139, 0.18);
  background: linear-gradient(160deg, rgba(18, 38, 67, 0.55), rgba(5, 11, 22, 0.65));
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  gap: 4px;
}
.higer-footer .hft-seal-luxury svg { color: var(--hft-gold-300); }
.higer-footer .hft-seal-luxury b {
  font-size: 11px;
  font-weight: 900;
  color: var(--hft-gold-200);
}
.higer-footer .hft-seal-luxury small {
  font-size: 9.5px;
  color: rgba(250, 247, 239, 0.58);
}

/* ================== ۴. نوار کلوفون پایینی ================== */
.higer-footer .hft-bottom {
  position: relative;
  z-index: 1;
  border-top: 1px solid rgba(243, 217, 139, 0.11);
  background: rgba(3, 7, 15, 0.58);
}
/* فاصله ایمن برای نوار چسبنده خرید موبایل در صفحه تک‌محصول */
@media (max-width: 1023px) {
  body.single-product .higer-footer .hft-bottom {
    padding-bottom: 84px;
  }
}
.higer-footer .hft-bottom-inner {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding-block: 20px;
  font-size: 11.5px;
  color: rgba(250, 247, 239, 0.58);
  text-align: center;
}
@media (min-width: 768px) {
  .higer-footer .hft-bottom-inner {
    flex-direction: row;
    text-align: right;
  }
}
.higer-footer .hft-bottom-links {
  display: flex;
  align-items: center;
  gap: 18px;
}
.higer-footer a.hft-policy-link {
  color: rgba(250, 247, 239, 0.65);
  transition: color 0.2s;
}
.higer-footer a.hft-policy-link:hover { color: var(--hft-gold-300); }

.higer-footer button.hft-top-btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 7px 14px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.26);
  background: rgba(255, 255, 255, 0.03);
  color: var(--hft-gold-300);
  font-size: 11.5px;
  font-weight: 800;
  transition: all 0.22s ease;
}
.higer-footer button.hft-top-btn:hover {
  border-color: var(--hft-gold-400);
  background: rgba(217, 161, 59, 0.14);
  transform: translateY(-2px);
}
</style>

<script id="higer-footer-script">
(function () {
  if (window.__higerFooterInit) return;
  window.__higerFooterInit = true;

  function boot() {
    var footers = document.querySelectorAll(".higer-footer");
    footers.forEach(function (root) {
      /* حالت تمام‌عرض دقیق (مشابه فرمول Shop Page.php برای پشتیبانی بی‌نقص از RTL) */
      if (root.getAttribute("data-hft-fw") === "yes") {
        var fit = function () {
          root.style.position = "relative";
          root.style.maxWidth = "none";
          root.style.left = "0px";
          root.style.width = document.documentElement.clientWidth + "px";
          root.style.left = -root.getBoundingClientRect().left + "px";
        };
        fit();
        window.addEventListener("resize", fit);
        window.addEventListener("load", fit);
        window.setTimeout(fit, 500);
      }

      var topBtn = root.querySelector("[data-hft-top]");
      if (topBtn) {
        topBtn.addEventListener("click", function () {
          window.scrollTo({ top: 0, behavior: "smooth" });
        });
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }
})();
</script>
		<?php
		return (string) ob_get_clean();
	}
}

/* ============================================================
   بخش ۴ — خروجی HTML فوتر و ثبت شورت‌کد [higer_footer]
   ============================================================ */

if ( ! function_exists( 'higer_footer_render' ) ) {
	function higer_footer_render( $atts = array() ) {
		static $rendered = false;
		if ( $rendered ) {
			return '';
		}
		$rendered = true;

		$atts = function_exists( 'shortcode_atts' )
			? shortcode_atts( array( 'fullwidth' => 'yes', 'cta' => 'auto' ), is_array( $atts ) ? $atts : array(), 'higer_footer' )
			: array( 'fullwidth' => 'yes', 'cta' => 'auto' );

		$cfg       = higer_footer_config();
		$fullwidth = 'no' !== strtolower( (string) $atts['fullwidth'] );
		$logo_src  = higer_footer_logo_src( $cfg );

		/* تشخیص هوشمند برای جلوگیری از تکرار باکس مشاوره در فروشگاه و محصول تکی */
		$show_cta = ! empty( $cfg['behavior']['show_cta_banner'] );
		if ( 'no' === strtolower( (string) $atts['cta'] ) ) {
			$show_cta = false;
		} elseif ( 'yes' === strtolower( (string) $atts['cta'] ) ) {
			$show_cta = true;
		} elseif ( $show_cta ) {
			/* صفحاتی که خودشان بخش مشاوره/تماس دارند: فروشگاه، محصول تکی، درباره ما و تماس با ما */
			$is_shop_or_product = ! empty( $cfg['behavior']['hide_cta_on_shop_product'] ) && (
				( function_exists( 'is_shop' ) && is_shop() )
				|| ( function_exists( 'is_product_category' ) && is_product_category() )
				|| ( function_exists( 'is_product' ) && is_product() )
			);
			$hide_pages  = ! empty( $cfg['behavior']['hide_cta_on_pages'] ) ? (array) $cfg['behavior']['hide_cta_on_pages'] : array();
			$is_own_page = $hide_pages && function_exists( 'is_page' ) && is_page( $hide_pages );
			$flagged     = ! empty( $GLOBALS['higer_suppress_footer_cta'] ); // توسط About Page.php / Contact Page.php تنظیم می‌شود
			if ( $is_shop_or_product || $is_own_page || $flagged ) {
				$show_cta = false;
			}
		}

		$active_socials = array();
		foreach ( (array) $cfg['socials'] as $soc ) {
			if ( ! empty( $soc['url'] ) ) {
				$active_socials[] = $soc;
			}
		}

		$has_seals  = ! empty( $cfg['trust']['enamad_html'] ) || ! empty( $cfg['trust']['samandehi_html'] );
		$map_q      = ! empty( $cfg['store']['map_query'] ) ? $cfg['store']['map_query'] : '';
		$map_url    = ! empty( $cfg['store']['map_url'] )
			? $cfg['store']['map_url']
			: ( '' !== $map_q ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $map_q ) : '' );
		$has_coords = isset( $cfg['store']['lat'], $cfg['store']['lng'] ) && is_numeric( $cfg['store']['lat'] ) && is_numeric( $cfg['store']['lng'] );
		$neshan_url = ! empty( $cfg['store']['neshan_url'] )
			? $cfg['store']['neshan_url']
			: ( $has_coords ? 'https://nshn.ir/?lat=' . rawurlencode( (string) $cfg['store']['lat'] ) . '&lng=' . rawurlencode( (string) $cfg['store']['lng'] ) : '' );

		ob_start();
		echo higer_footer_assets(); // phpcs:ignore
		?>
<footer class="higer-footer" role="contentinfo" data-hft-fw="<?php echo $fullwidth ? 'yes' : 'no'; ?>">
	<div class="hft-ambient-grid" aria-hidden="true"></div>

	<?php if ( $show_cta ) : ?>
	<div class="hft-wrap hft-concierge-sec">
		<div class="hft-concierge">
			<div>
				<span class="hft-eyebrow">
					<?php echo higer_footer_icon( 'gem', 13 ); // phpcs:ignore ?>
					<span><?php echo esc_html( $cfg['cta']['kicker'] ); ?></span>
				</span>
				<h2 class="hft-concierge-title">
					<?php echo esc_html( $cfg['cta']['title_a'] ); ?>
					<span class="hft-gold-text"><?php echo esc_html( $cfg['cta']['title_b'] ); ?></span>
				</h2>
				<p class="hft-concierge-sub"><?php echo esc_html( $cfg['cta']['subtitle'] ); ?></p>
			</div>
			<div class="hft-concierge-btns">
				<a href="<?php echo esc_url( $cfg['cta']['btn1_url'] ); ?>" class="hft-btn-gold">
					<span><?php echo esc_html( $cfg['cta']['btn1'] ); ?></span>
					<?php echo higer_footer_icon( 'arrow-l', 15 ); // phpcs:ignore ?>
				</a>
				<a href="<?php echo esc_url( $cfg['store']['tel'] ); ?>" class="hft-btn-outline">
					<?php echo higer_footer_icon( 'phone', 15 ); // phpcs:ignore ?>
					<span><?php echo esc_html( $cfg['cta']['btn2'] ); ?> — <?php echo esc_html( $cfg['store']['phone'] ); ?></span>
				</a>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( ! empty( $cfg['behavior']['show_pillars'] ) && ! empty( $cfg['pillars'] ) ) : ?>
	<div class="hft-pillars-wrap"<?php echo ! $show_cta ? ' style="margin-top:0;border-top:0"' : ''; ?>>
		<div class="hft-wrap">
			<div class="hft-pillars">
				<?php foreach ( $cfg['pillars'] as $p ) : ?>
					<div class="hft-pillar">
						<span class="hft-pillar-ring"><?php echo higer_footer_icon( $p['icon'], 18 ); // phpcs:ignore ?></span>
						<div>
							<b><?php echo esc_html( $p['title'] ); ?></b>
							<span><?php echo esc_html( $p['sub'] ); ?></span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="hft-wrap hft-main">
		<!-- ستون ۱: هویت برند و خط مستقیم فروش -->
		<div>
			<a href="<?php echo esc_url( $cfg['brand']['home_url'] ); ?>" class="hft-brand" aria-label="<?php echo esc_attr( $cfg['brand']['name'] ); ?>">
				<?php if ( $logo_src ) : ?>
					<img class="hft-logo" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( $cfg['brand']['name'] ); ?>" loading="lazy" decoding="async" onerror="this.style.display='none';if(this.nextElementSibling)this.nextElementSibling.style.display='inline-flex';">
					<span class="hft-crest" style="display:none">
						<span class="hft-crest-mark">H</span>
						<span class="hft-crest-copy">
							<b><?php echo esc_html( $cfg['brand']['name'] ); ?></b>
							<small><?php echo esc_html( $cfg['brand']['en_name'] ); ?></small>
						</span>
					</span>
				<?php else : ?>
					<span class="hft-crest">
						<span class="hft-crest-mark">H</span>
						<span class="hft-crest-copy">
							<b><?php echo esc_html( $cfg['brand']['name'] ); ?></b>
							<small><?php echo esc_html( $cfg['brand']['en_name'] ); ?></small>
						</span>
					</span>
				<?php endif; ?>
			</a>

			<p class="hft-desc"><?php echo esc_html( $cfg['brand']['description'] ); ?></p>

			<div class="hft-hotline">
				<span class="hft-hotline-label">
					<?php echo higer_footer_icon( 'phone', 13 ); // phpcs:ignore ?>
					<span>خطوط مستقیم مشاوره و فروش</span>
				</span>
				<div class="hft-hotline-nums">
					<a href="<?php echo esc_url( $cfg['store']['tel'] ); ?>" class="hft-hotline-num"><?php echo esc_html( $cfg['store']['phone'] ); ?></a>
					<?php if ( ! empty( $cfg['store']['landline'] ) ) : ?>
						<span class="hft-hotline-div" aria-hidden="true"></span>
						<a href="<?php echo esc_url( $cfg['store']['land_tel'] ); ?>" class="hft-hotline-num"><?php echo esc_html( $cfg['store']['landline'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( ! empty( $active_socials ) ) : ?>
				<span class="hft-social-cap">هیگر در پیام‌رسان‌ها و شبکه‌های اجتماعی</span>
				<div class="hft-socials">
					<?php foreach ( $active_socials as $soc ) : ?>
						<a href="<?php echo esc_url( $soc['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="hft-social" aria-label="<?php echo esc_attr( $soc['label'] . ' ' . $cfg['brand']['name'] ); ?>"<?php echo ! empty( $soc['handle'] ) ? ' title="' . esc_attr( $soc['handle'] ) . '"' : ''; ?>>
							<?php echo higer_footer_icon( $soc['key'], 15 ); // phpcs:ignore ?>
							<span><?php echo esc_html( $soc['label'] ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- ستون ۲: مجموعه محصولات -->
		<div>
			<h3 class="hft-col-head"><?php echo esc_html( $cfg['col_products']['title'] ); ?></h3>
			<ul class="hft-links">
				<?php foreach ( $cfg['col_products']['links'] as $link ) : ?>
					<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<!-- ستون ۳: راهنمای خرید و خدمات -->
		<div>
			<h3 class="hft-col-head"><?php echo esc_html( $cfg['col_quick']['title'] ); ?></h3>
			<ul class="hft-links">
				<?php foreach ( $cfg['col_quick']['links'] as $link ) : ?>
					<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<!-- ستون ۴: دفتر مرکزی و اصالت -->
		<div>
			<h3 class="hft-col-head">شوروم و دفتر مرکزی</h3>
			<div class="hft-showroom-card">
				<div class="hft-info-row">
					<span class="hft-info-ico"><?php echo higer_footer_icon( 'pin', 15 ); // phpcs:ignore ?></span>
					<span><?php echo esc_html( $cfg['store']['address'] ); ?></span>
				</div>
				<div class="hft-info-row">
					<span class="hft-info-ico"><?php echo higer_footer_icon( 'clock', 15 ); // phpcs:ignore ?></span>
					<span><?php echo esc_html( $cfg['store']['hours'] ); ?></span>
				</div>
				<?php if ( ! empty( $cfg['store']['email'] ) ) : ?>
				<div class="hft-info-row">
					<span class="hft-info-ico"><?php echo higer_footer_icon( 'mail', 15 ); // phpcs:ignore ?></span>
					<a href="mailto:<?php echo esc_attr( $cfg['store']['email'] ); ?>" style="direction:ltr;unicode-bidi:embed"><?php echo esc_html( $cfg['store']['email'] ); ?></a>
				</div>
				<?php endif; ?>
				<?php if ( '' !== $map_url || '' !== $neshan_url ) : ?>
				<div class="hft-map-links">
					<?php if ( '' !== $map_url ) : ?>
						<a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer" class="hft-map-link">
							<?php echo higer_footer_icon( 'navigate', 13 ); // phpcs:ignore ?>
							<span>مسیریابی در گوگل‌مپ</span>
						</a>
					<?php endif; ?>
					<?php if ( '' !== $neshan_url ) : ?>
						<a href="<?php echo esc_url( $neshan_url ); ?>" target="_blank" rel="noopener noreferrer" class="hft-map-link">
							<?php echo higer_footer_icon( 'pin', 13 ); // phpcs:ignore ?>
							<span>نشان</span>
						</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<div class="hft-seals">
				<?php if ( $has_seals ) : ?>
					<?php if ( ! empty( $cfg['trust']['enamad_html'] ) ) : ?>
						<div class="hft-seal-box"><?php echo $cfg['trust']['enamad_html']; // phpcs:ignore ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $cfg['trust']['samandehi_html'] ) ) : ?>
						<div class="hft-seal-box"><?php echo $cfg['trust']['samandehi_html']; // phpcs:ignore ?></div>
					<?php endif; ?>
				<?php else : ?>
					<div class="hft-seal-luxury">
						<?php echo higer_footer_icon( 'shield', 20 ); // phpcs:ignore ?>
						<b>اصالت و گارانتی هیگر</b>
						<small>ثبت رسمی از تاریخ فاکتور</small>
					</div>
					<div class="hft-seal-luxury">
						<?php echo higer_footer_icon( 'award', 20 ); // phpcs:ignore ?>
						<b>خرید امن مستقیم</b>
						<small>درگاه رسمی بانکی</small>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="hft-bottom">
		<div class="hft-wrap hft-bottom-inner">
			<p>© <?php echo esc_html( $cfg['year_fa'] ); ?> <?php echo esc_html( $cfg['brand']['name'] ); ?> — <?php echo esc_html( $cfg['copyright'] ); ?></p>
			<div class="hft-bottom-links">
				<?php if ( ! empty( $cfg['policy_url'] ) ) : ?>
					<a href="<?php echo esc_url( $cfg['policy_url'] ); ?>" class="hft-policy-link"><?php echo esc_html( $cfg['policy_label'] ); ?></a>
				<?php endif; ?>
				<?php if ( ! empty( $cfg['behavior']['show_back_to_top'] ) ) : ?>
					<button type="button" class="hft-top-btn" data-hft-top aria-label="بازگشت به بالای صفحه">
						<span>بازگشت به بالا</span>
						<?php echo higer_footer_icon( 'up', 14 ); // phpcs:ignore ?>
					</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
		<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_footer' ) ) {
	add_shortcode( 'higer_footer', 'higer_footer_render' );
}

if ( function_exists( 'add_action' ) ) {
	add_action( 'wp_footer', function () {
		$cfg = higer_footer_config();
		if ( ! empty( $cfg['behavior']['auto_inject'] ) ) {
			echo higer_footer_render(); // phpcs:ignore
		}
	}, 20 );
}
