<?php
/**
 * Higer Header — هدر اختصاصی تشک هیگر | نسخه لوکس بدون بیلد (v2.2)
 * =====================================================================
 * اسنیپت PHP مستقل برای افزونه WPCode، طراحی‌شده با ظرافت معماری و هماهنگ با
 * صفحه اصلی (Home Page.php)، فروشگاه (Shop Page.php) و محصول تکی (Single Product Page.php).
 *
 * ─── ویژگی‌های کلیدی نسخه ۲.۲ ───
 *  • واتساپ، تلگرام و اینستاگرام در پایین منوی کشویی موبایل (قابل ویرایش در بخش تنظیمات)
 *  • چیدمان موبایل استاندارد و متقارن: دکمه منو سمت راست، لوگو دقیقاً در مرکز، سبد خرید سمت چپ
 *  • لوگوی بزرگ‌تر و شارپ روی نمایشگرهای Retina (هم در دسکتاپ و هم در موبایل)
 *  • قفل کامل اسکرول صفحه زیرین هنگام پیمایش داخل منوی کشویی و سبد خرید (سازگار با iOS و اندروید)
 *  • ادغام ۱۰۰٪ رفتار اسنیپت قدیمی (.higer-header + .higer-glass): شفاف روی هیرو در صفحه اصلی
 *    دسکتاپ/تبلت، سرمه‌ای تیره #0d132e در سایر صفحات و موبایل، شیشه‌ای در اسکرول >30px
 *    (پس از فعال‌سازی این اسنیپت، اسنیپت قبلی هدر خود را حذف یا غیرفعال کنید.)
 *
 * ─── نصب در WPCode (۲ دقیقه) ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل همین فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *  ۴. Save و Activate
 *  ۵. در Elementor Pro > Theme Builder > Header ویجت‌های قبلی را حذف کرده
 *     و یک ویجت Shortcode با مقدار [higer_header] قرار دهید.
 *     (اگر از المنتور استفاده نمی‌کنید، در بخش تنظیمات 'auto_inject' را true کنید.)
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_header_config' ) ) :
function higer_header_config() {
	$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';
	$acct = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : rtrim( $home, '/' ) . '/my-account/';
	$cart = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : rtrim( $home, '/' ) . '/my-cart/';

	return array(
		/* --- هویت برند و لوگو --- */
		'brand' => array(
			'name'                => 'تشک هیگر',
			'en_name'             => 'HIGER MATTRESS',
			'heritage'            => 'تأسیس ۱۳۸۷',   // نشان ظریف کنار لوگو در دسکتاپ عریض (خالی = پنهان)
			'home_url'            => $home,
			'use_wp_logo'         => true,            // خواندن خودکار لوگو از سفارشی‌سازی وردپرس (سایز شارپ medium_large)
			'logo_url'            => 'https://higermattress.ir/wp-content/uploads/2026/08/logo-600x343.webp',
			'show_text_with_logo' => false,           // false = فقط لوگو؛ اگر لوگو لود نشود نشان اختصاصی نمایش می‌یابد
		),

		/* --- تماس سریع --- */
		'store' => array(
			'phone' => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'   => 'tel:+989111186485',
			'label' => 'مشاوره خرید',
		),

		/* --- رفتار فنی هدر --- */
		'behavior' => array(
			'auto_inject'        => false, // true = تزریق خودکار بدون نیاز به المنتور (wp_body_open)
			'scroll_threshold'   => 30,    // آستانه اسکرول برای حالت شیشه‌ای (پیکسل)
			'overlay_breakpoint' => 768,   // حداقل عرض برای حالت شفاف روی هیرو در صفحه اصلی (پیکسل)
			'show_search'        => true,  // جستجوی زنده محصولات
			'show_account'       => true,  // آیکون حساب کاربری
			'show_cart'          => true,  // سبد خرید و پنل کشویی AJAX
			'show_phone'         => true,  // شماره تماس مشاوره در دسکتاپ
			'open_cart_on_add'   => true,  // باز شدن خودکار سبد خرید هنگام افزودن محصول با AJAX
		),

		/* --- لینک‌های کلیدی --- */
		'urls' => array(
			'shop'    => $shop,
			'account' => $acct,
			'cart'    => $cart,
			'finder'  => rtrim( $home, '/' ) . '/#hg-finder',
		),

		/* --- آیتم‌های منوی اصلی --- */
		'nav' => array(
			array( 'label' => 'خانه',            'url' => $home,                                'key' => 'home' ),
			array( 'label' => 'محصولات',         'url' => $shop,                                'key' => 'shop',   'mega' => true ),
			array( 'label' => 'تشک‌سنج هوشمند',  'url' => rtrim( $home, '/' ) . '/#hg-finder',  'key' => 'finder', 'gem'  => true ),
			array( 'label' => 'درباره هیگر',     'url' => rtrim( $home, '/' ) . '/about/',      'key' => 'about' ),
			array( 'label' => 'تماس با ما',      'url' => rtrim( $home, '/' ) . '/contact-us/', 'key' => 'contact' ),
		),

		/* --- مگامنو: ۴ فناوری هسته تشک --- */
		'mega_cores' => array(
			array(
				'key'    => 'bonnell',
				'num'    => '۰۱',
				'title'  => 'فنر متصل',
				'en'     => 'BONNELL SPRING',
				'models' => 'کانگورو • اکونومیک • روکسانا • همر • تراست',
				'url'    => rtrim( $home, '/' ) . '/product-category/mattress/spring/bonnell-spring/',
			),
			array(
				'key'    => 'pocket',
				'num'    => '۰۲',
				'title'  => 'فنر منفصل پاکتی',
				'en'     => 'POCKET SPRING',
				'models' => 'الدورادو سوپرلوکس • تفکیک کامل لرزش',
				'url'    => rtrim( $home, '/' ) . '/product-category/mattress/spring/pocket-spring/',
			),
			array(
				'key'    => 'rebond',
				'num'    => '۰۳',
				'title'  => 'ریباند طبی',
				'en'     => 'REBOUNDED FOAM',
				'models' => 'راینو • رومانس • بدون فنر با استحکام بالا',
				'url'    => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/rebound/',
			),
			array(
				'key'    => 'foam',
				'num'    => '۰۴',
				'title'  => 'فوم سنگین',
				'en'     => 'HIGH-DENSITY FOAM',
				'models' => 'نایت • کوئین • اومئا • آوینا • هلسا',
				'url'    => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/high-density-foam/',
			),
		),

		/* --- مگامنو: کالای خواب مکمل --- */
		'mega_side' => array(
			array(
				'title' => 'تاپر تشک هیگر',
				'sub'   => 'لایه مکمل رویی برای تنظیم نرمی سطح خواب',
				'url'   => rtrim( $home, '/' ) . '/?s=' . rawurlencode( 'تاپر' ) . '&post_type=product',
			),
			array(
				'title' => 'محافظ تشک ضدحساسیت',
				'sub'   => 'پوشش محافظ سطح تشک در ۸ سایز استاندارد',
				'url'   => rtrim( $home, '/' ) . '/?s=' . rawurlencode( 'محافظ تشک' ) . '&post_type=product',
			),
			array(
				'title' => 'همه محصولات جانبی',
				'sub'   => 'مشاهده کامل مجموعه کالای خواب مکمل',
				'url'   => rtrim( $home, '/' ) . '/product-category/accessories/',
			),
		),

		/* --- پیام‌رسان‌ها و شبکه‌های اجتماعی (پایین منوی کشویی موبایل) ---
		   واتساپ: wa.me/شماره با کد کشور (بدون صفر و +) | تلگرام: t.me/+شماره یا t.me/نام‌کاربری
		   برای پنهان‌کردن هر مورد، مقدار url آن را خالی بگذارید. */
		'socials' => array(
			array( 'key' => 'whatsapp',  'label' => 'واتساپ',     'url' => 'https://wa.me/989111186485?text=' . rawurlencode( 'سلام، از سایت تشک هیگر پیام می‌دهم.' ) ),
			array( 'key' => 'telegram',  'label' => 'تلگرام',     'url' => 'https://t.me/+989111186485' ),
			array( 'key' => 'instagram', 'label' => 'اینستاگرام', 'url' => 'https://www.instagram.com/higer.mattress/' ),
		),
	);
}
endif;

/* ============================================================
   بخش ۲ — آیکون‌ها، دیاگرام‌های فنی و اتصال به ووکامرس
   ============================================================ */

if ( ! function_exists( 'higer_header_fa' ) ) {
	function higer_header_fa( $text ) {
		return strtr( (string) $text, array(
			'0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
			'5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
		) );
	}
}

if ( ! function_exists( 'higer_header_icon' ) ) {
	function higer_header_icon( $name, $size = 18 ) {
		$icons = array(
			'search'  => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.6-3.6"/>',
			'user'    => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
			'bag'     => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
			'phone'   => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'chevron' => '<path d="m6 9 6 6 6-6"/>',
			'arrow-l' => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'menu'    => '<path d="M4 7h16"/><path d="M8 12h12"/><path d="M4 17h16"/>',
			'close'   => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
			'gem'     => '<path d="M12 3l2.4 5.6L20 11l-5.6 2.4L12 19l-2.4-5.6L4 11l5.6-2.4L12 3z"/>',
			'moon'    => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
			'whatsapp'  => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
			'telegram'  => '<path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>',
			'instagram' => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
			'trash'   => '<path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>',
		);
		$path = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
		return '<svg width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* دیاگرام مقطع معماری ۴ هسته تشک در مگامنو */
if ( ! function_exists( 'higer_header_core_svg' ) ) {
	function higer_header_core_svg( $key ) {
		if ( 'bonnell' === $key ) {
			return '<svg viewBox="0 0 88 36" class="hh-core-svg" aria-hidden="true"><line x1="4" y1="5" x2="84" y2="5" stroke="#f3d98b" stroke-width="1.6" stroke-linecap="round" opacity=".8"/><line x1="4" y1="31" x2="84" y2="31" stroke="#f3d98b" stroke-width="1.6" stroke-linecap="round" opacity=".8"/><path d="M10 9l5 9-5 9M22 9l-5 9 5 9M34 9l5 9-5 9M46 9l-5 9 5 9M58 9l5 9-5 9M70 9l-5 9 5 9" stroke="#e7b95c" stroke-width="1.4" fill="none" stroke-linecap="round"/></svg>';
		}
		if ( 'pocket' === $key ) {
			return '<svg viewBox="0 0 88 36" class="hh-core-svg" aria-hidden="true"><rect x="6" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><rect x="26" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><rect x="46" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><rect x="66" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><path d="M10 11c8 2-2 5 8 7-8 2 2 5-8 7M30 11c8 2-2 5 8 7-8 2 2 5-8 7M50 11c8 2-2 5 8 7-8 2 2 5-8 7M70 11c8 2-2 5 8 7-8 2 2 5-8 7" stroke="#d9a13b" stroke-width="1.2" fill="none"/></svg>';
		}
		if ( 'rebond' === $key ) {
			return '<svg viewBox="0 0 88 36" class="hh-core-svg" aria-hidden="true"><rect x="5" y="7" width="78" height="22" rx="5" fill="rgba(217,161,59,.12)" stroke="#e7b95c" stroke-width="1.4"/><circle cx="15" cy="15" r="2.6" fill="#f3d98b" opacity=".85"/><circle cx="27" cy="22" r="2.2" fill="#d9a13b"/><circle cx="40" cy="14" r="2.8" fill="#e7b95c"/><circle cx="52" cy="22" r="2.4" fill="#f3d98b" opacity=".8"/><circle cx="65" cy="15" r="2.6" fill="#d9a13b"/><circle cx="75" cy="21" r="2.1" fill="#f3d98b"/></svg>';
		}
		return '<svg viewBox="0 0 88 36" class="hh-core-svg" aria-hidden="true"><path d="M5 11c22-4 56 4 78-1v7c-22 5-56-3-78 1z" fill="rgba(243,217,139,.18)" stroke="#f3d98b" stroke-width="1.3"/><path d="M5 22c22-3 56 4 78 0v6c-22 4-56-3-78 0z" fill="rgba(217,161,59,.16)" stroke="#d9a13b" stroke-width="1.3"/></svg>';
	}
}

if ( ! function_exists( 'higer_header_logo_src' ) ) {
	function higer_header_logo_src( $cfg ) {
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

if ( ! function_exists( 'higer_header_is_active' ) ) {
	function higer_header_is_active( $key ) {
		if ( 'home' === $key ) {
			return function_exists( 'is_front_page' ) && is_front_page();
		}
		if ( 'shop' === $key ) {
			return ( function_exists( 'is_shop' ) && is_shop() )
				|| ( function_exists( 'is_product_category' ) && is_product_category() )
				|| ( function_exists( 'is_product' ) && is_product() );
		}
		if ( 'about' === $key ) {
			return function_exists( 'is_page' ) && is_page( 'about' );
		}
		if ( 'contact' === $key ) {
			return function_exists( 'is_page' ) && is_page( 'contact-us' );
		}
		return false;
	}
}

if ( ! function_exists( 'higer_header_render_cart_badge' ) ) {
	function higer_header_render_cart_badge() {
		$count = ( function_exists( 'WC' ) && WC()->cart ) ? (int) WC()->cart->get_cart_contents_count() : 0;
		$cls   = 'hh-cart-badge' . ( $count > 0 ? ' has-items' : '' );
		return '<span class="' . $cls . '">' . esc_html( higer_header_fa( $count ) ) . '</span>';
	}
}

if ( ! function_exists( 'higer_header_render_cart_body' ) ) {
	function higer_header_render_cart_body() {
		$cfg      = higer_header_config();
		$wc       = function_exists( 'WC' ) ? WC() : null;
		$cart     = ( $wc && ! empty( $wc->cart ) ) ? $wc->cart : null;
		$items    = $cart ? $cart->get_cart() : array();
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $cfg['urls']['cart'];
		$chk_url  = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : home_url( '/checkout/' );
		$shop_url = $cfg['urls']['shop'];

		ob_start();
		?>
		<div class="hh-drawer-cart-body">
			<?php if ( empty( $items ) ) : ?>
				<div class="hh-cart-empty">
					<div class="hh-cart-empty-ring">
						<?php echo higer_header_icon( 'bag', 26 ); // phpcs:ignore ?>
					</div>
					<p class="hh-cart-empty-title">سبد خرید شما خالی است</p>
					<p class="hh-cart-empty-sub">مجموعه تشک‌های فنری و طبی هیگر را بررسی کنید یا با تشک‌سنج هوشمند، مدل دقیق متناسب با فرم خواب خود را بیابید.</p>
					<div class="hh-cart-empty-actions">
						<a href="<?php echo esc_url( $shop_url ); ?>" class="hh-btn-gold hh-full">ورود به فروشگاه هیگر</a>
						<a href="<?php echo esc_url( $cfg['urls']['finder'] ); ?>" class="hh-btn-outline hh-full">راهنمای هوشمند انتخاب تشک</a>
					</div>
				</div>
			<?php else : ?>
				<ul class="hh-cart-list" data-hh-scroll>
					<?php foreach ( $items as $cart_item_key => $cart_item ) :
						$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) {
							continue;
						}
						$name    = $_product->get_name();
						$link    = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
						$thumb   = $_product->get_image( 'woocommerce_gallery_thumbnail' );
						$price   = $cart->get_product_price( $_product );
						$qty     = (int) $cart_item['quantity'];
						$rem_url = function_exists( 'wc_get_cart_remove_url' ) ? wc_get_cart_remove_url( $cart_item_key ) : '#';
						?>
						<li class="hh-cart-item">
							<div class="hh-cart-thumb">
								<?php if ( $link ) : ?><a href="<?php echo esc_url( $link ); ?>"><?php endif; ?>
									<?php echo wp_kses_post( $thumb ); ?>
								<?php if ( $link ) : ?></a><?php endif; ?>
							</div>
							<div class="hh-cart-meta">
								<?php if ( $link ) : ?>
									<a class="hh-cart-title" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $name ); ?></a>
								<?php else : ?>
									<span class="hh-cart-title"><?php echo esc_html( $name ); ?></span>
								<?php endif; ?>
								<div class="hh-cart-price-row">
									<span class="hh-cart-qty"><?php echo esc_html( higer_header_fa( $qty ) ); ?> عدد ×</span>
									<span class="hh-cart-price"><?php echo wp_kses_post( $price ); ?></span>
								</div>
							</div>
							<a href="<?php echo esc_url( $rem_url ); ?>" class="hh-cart-remove remove_from_cart_button" aria-label="حذف از سبد خرید" data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
								<?php echo higer_header_icon( 'trash', 15 ); // phpcs:ignore ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="hh-cart-foot">
					<div class="hh-cart-total">
						<span>جمع جزء سبد خرید</span>
						<strong><?php echo wp_kses_post( $cart->get_cart_subtotal() ); ?></strong>
					</div>
					<div class="hh-cart-foot-btns">
						<a href="<?php echo esc_url( $chk_url ); ?>" class="hh-btn-gold hh-full">ادامه جهت تسویه حساب</a>
						<a href="<?php echo esc_url( $cart_url ); ?>" class="hh-btn-outline hh-full">مشاهده کامل سبد خرید</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
		return (string) ob_get_clean();
	}
}

if ( ! function_exists( 'higer_header_cart_fragments' ) ) {
	function higer_header_cart_fragments( $fragments ) {
		$fragments['span.hh-cart-badge']      = higer_header_render_cart_badge();
		$fragments['div.hh-drawer-cart-body'] = higer_header_render_cart_body();
		return $fragments;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'woocommerce_add_to_cart_fragments', 'higer_header_cart_fragments' );
	}
}

/* ============================================================
   بخش ۳ — استایل و اسکریپت لوکس هدر (فقط یک‌بار چاپ می‌شود)
   ============================================================ */

if ( ! function_exists( 'higer_header_assets' ) ) {
	function higer_header_assets( $cfg ) {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed   = true;
		$threshold = isset( $cfg['behavior']['scroll_threshold'] ) ? (int) $cfg['behavior']['scroll_threshold'] : 30;
		$bp        = isset( $cfg['behavior']['overlay_breakpoint'] ) ? (int) $cfg['behavior']['overlay_breakpoint'] : 768;
		$open_add  = ! empty( $cfg['behavior']['open_cart_on_add'] ) ? 'true' : 'false';
		$api_base  = function_exists( 'rest_url' ) ? rest_url( 'wc/store/v1/products' ) : '/wp-json/wc/store/v1/products';

		ob_start();
		?>
<style id="higer-header-styles">
/* ================== خنثی‌سازی فاصله‌های اضافی کانتینر المنتور ================== */
[data-elementor-type="header"],
.elementor-location-header {
  margin: 0 !important;
  padding: 0 !important;
  min-height: 0 !important;
  background: transparent !important;
  border: 0 !important;
}
[data-elementor-type="header"] .e-con,
.elementor-location-header .e-con,
[data-elementor-type="header"] .elementor-widget-container,
.elementor-location-header .elementor-widget-container {
  padding: 0 !important;
  margin: 0 !important;
  min-height: 0 !important;
  background: transparent !important;
}

/* قفل کامل اسکرول صفحه زیرین هنگام باز بودن منوی کشویی / سبد خرید */
html.hh-scroll-lock,
body.hh-scroll-lock {
  overflow: hidden !important;
  overscroll-behavior: none !important;
}

/* ================== رفتار اصلی هدر (جایگزین کامل اسنیپت قدیمی) ================== */
/* - صفحه اصلی (دسکتاپ و تبلت، از ۷۶۸px به بالا): اول کاملاً شفاف روی هیرو، در اسکرول شیشه‌ای
   - سایر صفحات و تمام صفحات موبایل: اول سرمه‌ای تیره #0d132e، در اسکرول شیشه‌ای */
.higer-header {
  --hh-navy-950: #070f1d;
  --hh-navy-header: #0d132e;
  --hh-navy-900: #10243e;
  --hh-navy-800: #183250;
  --hh-gold-600: #c8892a;
  --hh-gold-500: #d9a13b;
  --hh-gold-400: #e7b95c;
  --hh-gold-300: #f3d98b;
  --hh-gold-200: #f8ead0;
  --hh-cream: #faf7ef;

  position: fixed !important;
  top: 0 !important;
  right: 0 !important;
  left: 0 !important;
  width: 100% !important;
  z-index: 9999 !important;
  background: transparent !important;
  /* حیاتی: هیچ فیلتر یا ترنسفرمی روی خود هدر نباشد تا position:fixed پنل سبد خرید نشکند */
  filter: none !important;
  backdrop-filter: none !important;
  -webkit-backdrop-filter: none !important;
  transform: none !important;

  font-family: "IRANSans", "Vazirmatn", "Segoe UI", Tahoma, sans-serif;
  direction: rtl;
  text-align: right;
  color: var(--hh-cream);
  font-size: 16px;
  line-height: 1.5;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}
.higer-header *, .higer-header *::before, .higer-header *::after { box-sizing: border-box; }
.higer-header :is(ul, ol, p) { margin: 0; padding: 0; list-style: none; }
.higer-header a { text-decoration: none !important; color: inherit; background: none; }
.higer-header button {
  font: inherit; color: inherit; background: none; border: 0; border-radius: 0;
  padding: 0; margin: 0; cursor: pointer; box-shadow: none; text-transform: none; letter-spacing: normal;
}
.higer-header button:is(:hover, :focus) { background: none; color: inherit; }
.higer-header svg { display: block; flex-shrink: 0; }
.higer-header :focus-visible { outline: 2px solid var(--hh-gold-400); outline-offset: 3px; }

body.admin-bar .higer-header { top: 32px !important; }
@media screen and (max-width: 782px) {
  body.admin-bar .higer-header { top: 46px !important; }
}
body.elementor-editor-active .higer-header { position: relative !important; top: 0 !important; }

/* لایه شیشه‌ای مستقل پشت هدر (تنها لایه‌ای که رنگ و بلور دارد) */
.higer-header > .higer-glass {
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  background-color: #0d132e;
  backdrop-filter: blur(0px);
  -webkit-backdrop-filter: blur(0px);
  border-bottom: 1px solid rgba(243, 217, 139, 0.12);
  box-shadow: none;
  transition:
    background-color 0.35s ease,
    backdrop-filter 0.35s ease,
    -webkit-backdrop-filter 0.35s ease,
    border-color 0.35s ease,
    box-shadow 0.35s ease;
}
/* خط نوری شامپاینی بسیار ظریف در لبه بالایی */
.higer-header > .higer-glass::before {
  content: "";
  position: absolute;
  top: 0;
  right: 8%;
  left: 8%;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(243, 217, 139, 0.28), transparent);
  opacity: 0.85;
  transition: opacity 0.35s ease;
}

/* صفحه اصلی در دسکتاپ و تبلت: کاملاً شفاف روی هیرو */
body.higer-overlay .higer-header > .higer-glass {
  background-color: transparent;
  border-bottom-color: rgba(255, 255, 255, 0.07);
}
body.higer-overlay .higer-header > .higer-glass::before {
  opacity: 0;
}

/* بعد از اسکرول (در همه حالت‌ها): شیشه‌ای لوکس */
body .higer-header.is-scrolled > .higer-glass {
  background-color: rgba(13, 19, 46, 0.55);
  backdrop-filter: blur(22px) saturate(180%) brightness(1.05);
  -webkit-backdrop-filter: blur(22px) saturate(180%) brightness(1.05);
  border-bottom-color: rgba(235, 180, 70, 0.28);
  box-shadow:
    0 8px 32px rgba(0, 0, 0, 0.35),
    inset 0 1px 0 rgba(255, 255, 255, 0.14),
    inset 0 -1px 0 rgba(255, 255, 255, 0.05);
}
body .higer-header.is-scrolled > .higer-glass::before {
  opacity: 1;
}

/* رفع اسکرول افقی و دوخطی شدن منو */
html, body { overflow-x: clip !important; }
.higer-header ul, .higer-header nav, .higer-header > .hh-bar a { white-space: nowrap !important; }

/* ================== معماری ۳ ستونه متقارن نوار هدر ================== */
/* در موبایل و تبلت (<1024px):
   ستون ۱ (سمت راست): دکمه همبرگر منو
   ستون ۲ (دقیقاً وسط): لوگوی بزرگ‌تر برند
   ستون ۳ (سمت چپ): جستجو و سبد خرید
   در دسکتاپ (>=1024px):
   ستون ۱ (سمت راست): لوگو + سال تأسیس
   ستون ۲ (وسط): منوی اصلی
   ستون ۳ (سمت چپ): تلفن مشاوره + کپسول ابزارها */
.higer-header .hh-bar {
  position: relative;
  max-width: 1320px;
  margin-inline: auto;
  padding-inline: 14px;
  height: 74px;
  display: grid;
  grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr);
  align-items: center;
  gap: 8px;
  transition: height 0.32s cubic-bezier(0.22, 1, 0.36, 1);
}
@media (min-width: 640px) {
  .higer-header .hh-bar { padding-inline: 24px; gap: 16px; }
}
@media (min-width: 1024px) {
  .higer-header .hh-bar { height: 92px; }
  .higer-header.is-scrolled .hh-bar { height: 76px; }
}

/* دکمه منوی موبایل — سمت راست صفحه در موبایل/تبلت */
.higer-header button.hh-burger {
  grid-column: 1;
  justify-self: start;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 1px solid rgba(243, 217, 139, 0.26);
  background: rgba(7, 15, 29, 0.42);
  color: var(--hh-cream);
  display: inline-grid;
  place-items: center;
  transition: border-color 0.2s, color 0.2s, background-color 0.2s;
}
.higer-header button.hh-burger:hover {
  border-color: var(--hh-gold-400);
  color: var(--hh-gold-300);
  background: rgba(217, 161, 59, 0.12);
}
@media (min-width: 1024px) {
  .higer-header button.hh-burger { display: none; }
}

/* امضای برند و لوگو — وسط در موبایل، سمت راست در دسکتاپ */
.higer-header .hh-brand-zone {
  grid-column: 2;
  justify-self: center;
  display: flex;
  align-items: center;
  gap: 14px;
  flex-shrink: 0;
}
@media (min-width: 1024px) {
  .higer-header .hh-brand-zone {
    grid-column: 1;
    justify-self: start;
  }
}
.higer-header a.hh-brand {
  display: inline-flex;
  align-items: center;
  gap: 11px;
  color: var(--hh-cream);
}
.higer-header .hh-logo-img {
  height: 50px;
  width: auto;
  max-width: 184px;
  object-fit: contain;
  display: block;
  transition: height 0.3s ease, transform 0.3s ease;
}
@media (max-width: 374px) {
  .higer-header .hh-logo-img { height: 44px; max-width: 152px; }
}
@media (min-width: 1024px) {
  .higer-header .hh-logo-img { height: 60px; max-width: 220px; }
  .higer-header.is-scrolled .hh-logo-img { height: 50px; }
}
.higer-header a.hh-brand:hover .hh-logo-img { transform: translateY(-1px); }

/* نشان اختصاصی پشتیبان (اگر لوگو تنظیم نشده باشد) */
.higer-header .hh-crest-fallback {
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.higer-header .hh-crest-mark {
  width: 42px;
  height: 42px;
  border-radius: 12px;
  border: 1px solid rgba(243, 217, 139, 0.42);
  background: radial-gradient(circle at 30% 25%, rgba(236, 196, 112, 0.28), rgba(13, 19, 46, 0.7));
  display: grid;
  place-items: center;
  color: var(--hh-gold-300);
  font-weight: 900;
  font-size: 18px;
  letter-spacing: 0.05em;
}
.higer-header .hh-crest-text b {
  display: block;
  font-size: 16.5px;
  font-weight: 900;
  color: var(--hh-cream);
  line-height: 1.2;
}
.higer-header .hh-crest-text small {
  display: block;
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: 0.16em;
  color: var(--hh-gold-300);
  opacity: 0.85;
}
.higer-header .hh-heritage {
  display: none;
  align-items: center;
  gap: 12px;
  font-size: 11px;
  font-weight: 700;
  color: rgba(243, 217, 139, 0.72);
  letter-spacing: 0.01em;
}
.higer-header .hh-heritage::before {
  content: "";
  width: 1px;
  height: 22px;
  background: linear-gradient(180deg, transparent, rgba(243, 217, 139, 0.35), transparent);
}
@media (min-width: 1280px) { .higer-header .hh-heritage { display: inline-flex; } }

/* ناوبری ادیتوریال وسط (دسکتاپ) */
.higer-header .hh-nav {
  display: none;
  align-items: center;
}
@media (min-width: 1024px) {
  .higer-header .hh-nav {
    display: flex;
    grid-column: 2;
    justify-self: center;
  }
}

.higer-header .hh-nav-list {
  display: flex;
  align-items: center;
  gap: 26px;
}
@media (min-width: 1200px) { .higer-header .hh-nav-list { gap: 32px; } }

.higer-header .hh-nav-item { position: relative; }
.higer-header a.hh-nav-link {
  position: relative;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 10px 2px;
  font-size: 13.5px;
  font-weight: 700;
  color: rgba(250, 247, 239, 0.84);
  transition: color 0.24s ease;
}
.higer-header a.hh-nav-link::after {
  content: "";
  position: absolute;
  right: 0;
  left: 0;
  bottom: 2px;
  height: 1.5px;
  border-radius: 99px;
  background: linear-gradient(90deg, transparent, var(--hh-gold-300), var(--hh-gold-500), transparent);
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
}
.higer-header a.hh-nav-link:hover,
.higer-header a.hh-nav-link.is-active,
.higer-header .hh-nav-item.is-open > a.hh-nav-link {
  color: var(--hh-gold-200);
}
.higer-header a.hh-nav-link:hover::after,
.higer-header a.hh-nav-link.is-active::after,
.higer-header .hh-nav-item.is-open > a.hh-nav-link::after {
  transform: scaleX(1);
}
.higer-header a.hh-nav-link.is-gem {
  color: var(--hh-gold-300);
}
.higer-header .hh-gem-ico {
  color: var(--hh-gold-400);
  filter: drop-shadow(0 0 6px rgba(231, 185, 92, 0.45));
}
.higer-header .hh-caret {
  opacity: 0.7;
  transition: transform 0.25s ease, color 0.25s ease;
}
.higer-header .hh-nav-item.is-open .hh-caret {
  transform: rotate(180deg);
  color: var(--hh-gold-400);
  opacity: 1;
}

/* ================== مگامنو معماری محصولات ================== */
.higer-header .hh-mega-anchor {
  position: static;
}
.higer-header .hh-mega {
  position: absolute;
  top: calc(100% + 8px);
  right: 16px;
  left: 16px;
  max-width: 980px;
  margin-inline: auto;
  padding: 22px;
  border-radius: 24px;
  border: 1px solid rgba(243, 217, 139, 0.24);
  background:
    radial-gradient(640px 280px at 92% 0%, rgba(217, 161, 59, 0.13), transparent 65%),
    linear-gradient(165deg, #091326 0%, #0e1f38 55%, #132a49 100%);
  box-shadow:
    0 32px 80px rgba(3, 8, 18, 0.72),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition:
    opacity 0.26s cubic-bezier(0.22, 1, 0.36, 1),
    transform 0.26s cubic-bezier(0.22, 1, 0.36, 1),
    visibility 0.26s;
  pointer-events: none;
  z-index: 60;
}
.higer-header .hh-nav-item.is-open .hh-mega {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
  pointer-events: auto;
}
.higer-header .hh-mega-layout {
  display: grid;
  grid-template-columns: 1.45fr 0.85fr 0.85fr;
  gap: 20px;
  align-items: stretch;
}
.higer-header .hh-mega-eyebrow {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: 10px;
  margin-bottom: 12px;
  border-bottom: 1px solid rgba(243, 217, 139, 0.13);
  font-size: 11px;
  font-weight: 800;
  color: var(--hh-gold-300);
  letter-spacing: 0.01em;
}
.higer-header a.hh-mega-viewall {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 11px;
  font-weight: 700;
  color: rgba(250, 247, 239, 0.75);
  transition: color 0.2s, transform 0.2s;
}
.higer-header a.hh-mega-viewall:hover {
  color: var(--hh-gold-300);
  transform: translateX(-2px);
}
.higer-header .hh-mega-cores {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.higer-header a.hh-core-card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 8px;
  padding: 13px 14px;
  border-radius: 16px;
  border: 1px solid rgba(243, 217, 139, 0.12);
  background: rgba(7, 15, 29, 0.46);
  white-space: normal !important;
  transition: border-color 0.22s ease, background-color 0.22s ease, transform 0.22s ease;
}
.higer-header a.hh-core-card:hover {
  border-color: rgba(217, 161, 59, 0.55);
  background: rgba(217, 161, 59, 0.09);
  transform: translateY(-2px);
}
.higer-header .hh-core-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
}
.higer-header .hh-core-svg {
  width: 66px;
  height: 27px;
}
.higer-header .hh-core-num {
  font-size: 10px;
  font-weight: 900;
  color: var(--hh-gold-300);
  opacity: 0.75;
}
.higer-header .hh-core-title {
  display: block;
  font-size: 13px;
  font-weight: 900;
  color: var(--hh-cream);
}
.higer-header .hh-core-en {
  display: block;
  font-size: 9px;
  font-weight: 700;
  letter-spacing: 0.08em;
  color: var(--hh-gold-400);
  opacity: 0.8;
  margin-top: 1px;
}
.higer-header .hh-core-models {
  display: block;
  font-size: 10.5px;
  line-height: 1.65;
  color: rgba(250, 247, 239, 0.65);
  white-space: normal !important;
}

.higer-header .hh-mega-col-mid {
  padding-inline: 18px;
  border-inline: 1px solid rgba(243, 217, 139, 0.12);
  display: flex;
  flex-direction: column;
}
.higer-header .hh-side-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.higer-header a.hh-side-item {
  display: block;
  padding: 10px 12px;
  border-radius: 13px;
  border: 1px solid rgba(255, 255, 255, 0.06);
  background: rgba(255, 255, 255, 0.025);
  white-space: normal !important;
  transition: border-color 0.2s, background-color 0.2s;
}
.higer-header a.hh-side-item:hover {
  border-color: rgba(217, 161, 59, 0.45);
  background: rgba(217, 161, 59, 0.08);
}
.higer-header a.hh-side-item strong {
  display: block;
  font-size: 12.5px;
  font-weight: 800;
  color: var(--hh-cream);
}
.higer-header a.hh-side-item span {
  display: block;
  margin-top: 3px;
  font-size: 10.5px;
  line-height: 1.6;
  color: rgba(250, 247, 239, 0.62);
  white-space: normal !important;
}

.higer-header .hh-mega-concierge {
  position: relative;
  overflow: hidden;
  border-radius: 18px;
  padding: 18px 16px;
  border: 1px solid rgba(217, 161, 59, 0.38);
  background:
    radial-gradient(240px 160px at 85% 0%, rgba(236, 196, 112, 0.22), transparent 70%),
    linear-gradient(165deg, rgba(16, 36, 62, 0.9), rgba(7, 15, 29, 0.92));
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 14px;
  white-space: normal !important;
}
.higer-header .hh-concierge-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  align-self: flex-start;
  padding: 4px 10px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.35);
  background: rgba(217, 161, 59, 0.14);
  font-size: 10px;
  font-weight: 800;
  color: var(--hh-gold-300);
}
.higer-header .hh-mega-concierge h4 {
  margin: 10px 0 6px;
  font-size: 15px;
  font-weight: 900;
  line-height: 1.5;
  color: var(--hh-cream);
  white-space: normal !important;
}
.higer-header .hh-mega-concierge p {
  font-size: 11px;
  line-height: 1.85;
  color: rgba(248, 234, 208, 0.78);
  white-space: normal !important;
}

/* ================== ستون ۳: کپسول ابزارهای سمت چپ ================== */
.higer-header .hh-actions {
  grid-column: 3;
  justify-self: end;
  display: flex;
  align-items: center;
  gap: 10px;
  flex-shrink: 0;
}
.higer-header a.hh-tel-link {
  display: none;
  align-items: center;
  gap: 8px;
  padding: 6px 12px;
  border-radius: 999px;
  color: rgba(250, 247, 239, 0.88);
  transition: color 0.2s, background-color 0.2s;
}
@media (min-width: 1180px) { .higer-header a.hh-tel-link { display: inline-flex; } }
.higer-header a.hh-tel-link:hover {
  color: var(--hh-gold-300);
  background: rgba(243, 217, 139, 0.07);
}
.higer-header .hh-tel-ring {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  border: 1px solid rgba(243, 217, 139, 0.32);
  background: rgba(217, 161, 59, 0.1);
  color: var(--hh-gold-300);
  display: grid;
  place-items: center;
}
.higer-header .hh-tel-num {
  font-size: 12.5px;
  font-weight: 800;
  letter-spacing: 0.02em;
  direction: ltr;
  unicode-bidi: embed;
}
.higer-header .hh-sep {
  display: none;
  width: 1px;
  height: 22px;
  background: linear-gradient(180deg, transparent, rgba(243, 217, 139, 0.28), transparent);
}
@media (min-width: 1180px) { .higer-header .hh-sep { display: block; } }

.higer-header .hh-capsule {
  display: inline-flex;
  align-items: center;
  gap: 3px;
  padding: 3px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.2);
  background: rgba(7, 15, 29, 0.38);
}
@media (min-width: 640px) {
  .higer-header .hh-capsule { padding: 4px; }
}
.higer-header :is(button, a).hh-cap-btn {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: inline-grid;
  place-items: center;
  color: rgba(250, 247, 239, 0.88);
  transition: color 0.2s ease, background-color 0.2s ease;
}
@media (min-width: 640px) {
  .higer-header :is(button, a).hh-cap-btn { width: 36px; height: 36px; }
}
.higer-header :is(button, a).hh-cap-btn:hover {
  color: var(--hh-gold-300);
  background: rgba(243, 217, 139, 0.11);
}
@media (max-width: 767px) {
  .higer-header a.hh-cap-account { display: none; }
}
.higer-header button.hh-cart-pill {
  height: 34px;
  padding: 0 10px 0 8px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border: 1px solid rgba(231, 185, 92, 0.38);
  background: linear-gradient(180deg, rgba(217, 161, 59, 0.22), rgba(217, 161, 59, 0.08));
  color: var(--hh-cream);
  transition: border-color 0.22s ease, background-color 0.22s ease;
}
@media (min-width: 640px) {
  .higer-header button.hh-cart-pill { height: 36px; padding: 0 12px 0 10px; gap: 7px; }
}
.higer-header button.hh-cart-pill:hover {
  border-color: rgba(243, 217, 139, 0.75);
  color: var(--hh-gold-200);
}
.higer-header .hh-cart-badge {
  min-width: 19px;
  height: 19px;
  padding: 0 5px;
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.14);
  color: var(--hh-cream);
  font-size: 11px;
  font-weight: 900;
  line-height: 1;
  display: inline-grid;
  place-items: center;
}
.higer-header .hh-cart-badge.has-items {
  background: linear-gradient(180deg, #ecc470, #d9a13b);
  color: var(--hh-navy-900);
  box-shadow: 0 2px 10px rgba(217, 161, 59, 0.45);
}

/* ================== پنل‌های کشویی (با مهار کامل اسکرول صفحه زیرین) ================== */
.hh-backdrop {
  position: fixed;
  inset: 0;
  z-index: 10010;
  background: rgba(4, 10, 22, 0.72);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  opacity: 0;
  visibility: hidden;
  touch-action: none;
  overscroll-behavior: none;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}
.hh-backdrop.is-open { opacity: 1; visibility: visible; }

.hh-drawer {
  position: fixed;
  top: 0;
  bottom: 0;
  width: min(400px, 90vw);
  z-index: 10020;
  display: flex;
  flex-direction: column;
  overscroll-behavior: contain;
  background:
    radial-gradient(420px 240px at 85% 0%, rgba(217, 161, 59, 0.12), transparent 70%),
    linear-gradient(170deg, #091326 0%, #0e1f38 58%, #070f1d 100%);
  color: #faf7ef;
  font-family: "IRANSans", "Vazirmatn", "Segoe UI", Tahoma, sans-serif;
  direction: rtl;
  text-align: right;
  box-shadow: 0 24px 70px rgba(0, 0, 0, 0.65);
  transition: transform 0.36s cubic-bezier(0.22, 1, 0.36, 1);
}
.hh-drawer *, .hh-drawer *::before, .hh-drawer *::after { box-sizing: border-box; }
.hh-drawer a { text-decoration: none !important; color: inherit; }
.hh-drawer button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; padding: 0; }
.hh-drawer-left { left: 0; border-right: 1px solid rgba(243, 217, 139, 0.22); transform: translateX(-104%); }
.hh-drawer-right { right: 0; border-left: 1px solid rgba(243, 217, 139, 0.22); transform: translateX(104%); }
.hh-drawer.is-open { transform: translateX(0); }

.hh-drawer-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid rgba(243, 217, 139, 0.15);
  background: rgba(7, 15, 29, 0.42);
  touch-action: none;
  flex-shrink: 0;
}
.hh-drawer-logo {
  height: 44px;
  width: auto;
  max-width: 164px;
  object-fit: contain;
  display: block;
}
.hh-drawer-title {
  display: flex;
  align-items: center;
  gap: 9px;
  margin: 0;
  font-size: 14.5px;
  font-weight: 900;
  color: #f3d98b;
}
.hh-close-btn {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid rgba(243, 217, 139, 0.22);
  background: rgba(255, 255, 255, 0.04);
  color: #faf7ef;
  display: inline-grid;
  place-items: center;
  transition: border-color 0.2s, background-color 0.2s, color 0.2s;
}
.hh-close-btn:hover {
  border-color: #e7b95c;
  background: rgba(217, 161, 59, 0.14);
  color: #f3d98b;
}

/* دکمه‌های لوکس مشترک */
.hh-btn-gold {
  position: relative;
  overflow: hidden;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 20px;
  border-radius: 999px;
  background: linear-gradient(180deg, #ecc470 0%, #d9a13b 55%, #c8892a 100%);
  color: #10243e !important;
  font-size: 12.5px;
  font-weight: 900;
  box-shadow: 0 10px 24px rgba(217, 161, 59, 0.34), inset 0 1px 0 rgba(255, 255, 255, 0.72);
  transition: transform 0.22s ease, filter 0.22s ease;
}
.hh-btn-gold:hover { transform: translateY(-1px); filter: brightness(1.04); }
.hh-btn-outline {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 11px 18px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.34);
  color: #f3d98b !important;
  font-size: 12px;
  font-weight: 700;
  transition: background-color 0.2s, border-color 0.2s;
}
.hh-btn-outline:hover {
  background: rgba(243, 217, 139, 0.09);
  border-color: rgba(243, 217, 139, 0.7);
}
.hh-full { width: 100%; }

/* سبد خرید کشویی */
.hh-drawer-cart-body { display: flex; flex-direction: column; flex: 1; min-height: 0; }
.hh-cart-empty { margin: auto; padding: 36px 24px; text-align: center; touch-action: none; }
.hh-cart-empty-ring {
  width: 64px;
  height: 64px;
  margin: 0 auto 16px;
  border-radius: 50%;
  border: 1px solid rgba(243, 217, 139, 0.32);
  background: radial-gradient(circle, rgba(217, 161, 59, 0.2), rgba(7, 15, 29, 0.4));
  color: #e7b95c;
  display: grid;
  place-items: center;
}
.hh-cart-empty-title { margin: 0; font-size: 15px; font-weight: 900; color: #faf7ef; }
.hh-cart-empty-sub { margin: 8px 0 22px; font-size: 12px; line-height: 1.95; color: rgba(250, 247, 239, 0.68); }
.hh-cart-empty-actions { display: grid; gap: 10px; }

.hh-cart-list {
  flex: 1;
  overflow-y: auto;
  overscroll-behavior: contain;
  -webkit-overflow-scrolling: touch;
  touch-action: pan-y;
  list-style: none;
  margin: 0;
  padding: 16px 18px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.hh-cart-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 11px;
  border-radius: 16px;
  border: 1px solid rgba(243, 217, 139, 0.14);
  background: rgba(7, 15, 29, 0.48);
}
.hh-cart-thumb {
  width: 60px;
  height: 60px;
  border-radius: 12px;
  overflow: hidden;
  background: #183250;
  border: 1px solid rgba(243, 217, 139, 0.15);
  flex-shrink: 0;
}
.hh-cart-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
.hh-cart-meta { flex: 1; min-width: 0; }
.hh-cart-title {
  display: block;
  font-size: 12.5px;
  font-weight: 800;
  color: #faf7ef;
  line-height: 1.5;
}
.hh-cart-price-row {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: 4px;
  font-size: 12px;
  font-weight: 700;
  color: #f3d98b;
}
.hh-cart-qty { opacity: 0.72; font-size: 11px; }
.hh-cart-remove {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  color: rgba(250, 247, 239, 0.5);
  display: grid;
  place-items: center;
  flex-shrink: 0;
  transition: color 0.2s, background-color 0.2s;
}
.hh-cart-remove:hover { color: #fca5a5; background: rgba(239, 68, 68, 0.15); }
.hh-cart-foot {
  padding: 16px 20px 20px;
  border-top: 1px solid rgba(243, 217, 139, 0.16);
  background: rgba(7, 15, 29, 0.62);
  touch-action: none;
  flex-shrink: 0;
}
.hh-cart-total {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 14px;
  font-size: 12.5px;
  color: rgba(250, 247, 239, 0.78);
}
.hh-cart-total strong { font-size: 16px; font-weight: 900; color: #f3d98b; }
.hh-cart-foot-btns { display: grid; gap: 8px; }

/* منوی کشویی موبایل (بازشو از سمت راست با قفل کامل زنجیره اسکرول) */
.hh-mob-body {
  flex: 1;
  min-height: 0;
  overflow-y: auto;
  overscroll-behavior: contain;
  -webkit-overflow-scrolling: touch;
  touch-action: pan-y;
  padding: 16px 18px;
  display: flex;
  flex-direction: column;
  gap: 7px;
}
.hh-mob-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 13px 14px;
  border-radius: 14px;
  font-size: 13.5px;
  font-weight: 800;
  color: rgba(250, 247, 239, 0.9);
  border: 1px solid rgba(255, 255, 255, 0.05);
  background: rgba(255, 255, 255, 0.025);
  text-align: right;
  transition: border-color 0.2s, background-color 0.2s, color 0.2s;
}
.hh-mob-link.is-active, .hh-mob-link:hover {
  color: #f3d98b;
  border-color: rgba(217, 161, 59, 0.35);
  background: rgba(217, 161, 59, 0.09);
}
.hh-mob-link.is-gem {
  color: #f3d98b;
  border-color: rgba(243, 217, 139, 0.34);
  background: linear-gradient(135deg, rgba(217, 161, 59, 0.16), rgba(7, 15, 29, 0.45));
}
.hh-mob-sub {
  display: none;
  flex-direction: column;
  gap: 4px;
  padding: 8px 12px 8px 4px;
  margin: 4px 10px 6px 0;
  border-right: 1.5px solid rgba(217, 161, 59, 0.38);
}
.hh-mob-acc.is-open .hh-mob-sub { display: flex; }
.hh-mob-acc.is-open .hh-caret { transform: rotate(180deg); color: #e7b95c; }
.hh-mob-sub a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 9px 10px;
  border-radius: 10px;
  font-size: 12.5px;
  font-weight: 700;
  color: rgba(250, 247, 239, 0.8);
}
.hh-mob-sub a:hover { background: rgba(217, 161, 59, 0.1); color: #f3d98b; }
.hh-mob-foot {
  padding: 16px 18px 20px;
  border-top: 1px solid rgba(243, 217, 139, 0.15);
  background: rgba(7, 15, 29, 0.58);
  display: grid;
  gap: 9px;
  touch-action: none;
  flex-shrink: 0;
}

/* پیام‌رسان‌ها و شبکه‌های اجتماعی در پایین منوی موبایل */
.hh-mob-social {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-top: 2px;
  padding-top: 11px;
  border-top: 1px solid rgba(243, 217, 139, 0.13);
}
.hh-mob-social-cap {
  font-size: 11.5px;
  font-weight: 700;
  color: rgba(250, 247, 239, 0.7);
}
.hh-mob-social-links {
  display: flex;
  align-items: center;
  gap: 8px;
}
.hh-drawer a.hh-social-dot {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  border: 1px solid rgba(243, 217, 139, 0.3);
  background: rgba(217, 161, 59, 0.1);
  color: #f3d98b;
  display: inline-grid;
  place-items: center;
  transition: border-color 0.2s, background-color 0.2s, transform 0.2s;
}
.hh-drawer a.hh-social-dot:hover {
  border-color: #e7b95c;
  background: rgba(217, 161, 59, 0.22);
  transform: translateY(-2px);
}
.hh-drawer a.hh-social-dot svg { display: block; }

/* مودال جستجوی زنده (Spotlight) */
.hh-search-modal {
  position: fixed;
  inset: 0;
  z-index: 10030;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: min(12vh, 96px) 16px 24px;
  background: rgba(4, 10, 22, 0.78);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  opacity: 0;
  visibility: hidden;
  overscroll-behavior: contain;
  transition: opacity 0.25s ease, visibility 0.25s ease;
  font-family: "IRANSans", "Vazirmatn", "Segoe UI", Tahoma, sans-serif;
  direction: rtl;
  text-align: right;
}
.hh-search-modal.is-open { opacity: 1; visibility: visible; }
.hh-search-box {
  width: min(640px, 100%);
  border-radius: 24px;
  border: 1px solid rgba(243, 217, 139, 0.28);
  background: linear-gradient(165deg, #091326 0%, #10243e 100%);
  box-shadow: 0 32px 84px rgba(0, 0, 0, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.08);
  overflow: hidden;
  transform: translateY(-10px) scale(0.99);
  transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1);
}
.hh-search-modal.is-open .hh-search-box { transform: translateY(0) scale(1); }
.hh-search-form {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 15px 18px;
  border-bottom: 1px solid rgba(243, 217, 139, 0.15);
  color: #f3d98b;
  touch-action: none;
}
.hh-search-input {
  flex: 1;
  background: transparent;
  border: 0;
  outline: none;
  color: #faf7ef;
  font: inherit;
  font-size: 14.5px;
  font-weight: 700;
}
.hh-search-input::placeholder { color: rgba(250, 247, 239, 0.42); font-weight: 500; }
.hh-search-results {
  max-height: 360px;
  overflow-y: auto;
  overscroll-behavior: contain;
  -webkit-overflow-scrolling: touch;
  touch-action: pan-y;
  padding: 16px 18px 18px;
}
.hh-search-hint { margin: 0; font-size: 12px; color: rgba(250, 247, 239, 0.62); line-height: 1.8; }
.hh-search-chips { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 12px; }
.hh-search-chip {
  padding: 6px 13px;
  border-radius: 999px;
  border: 1px solid rgba(243, 217, 139, 0.22);
  background: rgba(255, 255, 255, 0.035);
  color: #f8ead0;
  font: inherit;
  font-size: 11.5px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s;
}
.hh-search-chip:hover { border-color: #d9a13b; background: rgba(217, 161, 59, 0.14); color: #f3d98b; }
.hh-search-list { display: grid; gap: 8px; list-style: none; margin: 0; padding: 0; }
.hh-search-item a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(243, 217, 139, 0.12);
  background: rgba(7, 15, 29, 0.46);
  text-decoration: none;
  transition: border-color 0.2s, background-color 0.2s;
}
.hh-search-item a:hover { border-color: rgba(217, 161, 59, 0.52); background: rgba(217, 161, 59, 0.1); }
.hh-search-thumb { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; background: #183250; flex-shrink: 0; }
.hh-search-title { display: block; font-size: 13px; font-weight: 800; color: #faf7ef; }
.hh-search-price { display: block; font-size: 11.5px; font-weight: 700; color: #f3d98b; margin-top: 2px; }
</style>

<script id="higer-header-script">
(function () {
  if (window.__higerHeaderInit) return;
  window.__higerHeaderInit = true;

  var FONTS = [
    "https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css",
    "https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css"
  ];

  function ensureFonts() {
    var head = document.head || document.documentElement;
    FONTS.forEach(function (href) {
      if (document.querySelector('link[href="' + href + '"]')) return;
      var l = document.createElement("link");
      l.rel = "stylesheet";
      l.href = href;
      head.appendChild(l);
    });
  }

  function boot() {
    ensureFonts();
    var header = document.querySelector(".higer-header");
    if (!header) return;

    var docEl = document.documentElement;
    var body = document.body;
    var threshold = <?php echo (int) $threshold; ?>;
    var mq = window.matchMedia("(min-width: <?php echo (int) $bp; ?>px)");
    var isHome = header.getAttribute("data-is-home") === "1" || body.classList.contains("home") || location.pathname === "/";

    /* ساخت یا تضمین لایه شیشه‌ای مستقل پشت هدر */
    if (!header.querySelector(".higer-glass")) {
      var glass = document.createElement("div");
      glass.className = "higer-glass";
      header.insertBefore(glass, header.firstChild);
    }

    /* انتقال پنل‌های کشویی fixed مستقیم به body */
    ["hh-backdrop", "hh-cart-drawer", "hh-mob-drawer", "hh-search-modal"].forEach(function (id) {
      var el = document.getElementById(id);
      if (el && el.parentNode !== body) body.appendChild(el);
    });

    /* حالت شفاف روی هیرو فقط در صفحه اصلی + دسکتاپ/تبلت؛ در سایر حالات padding-top خودکار */
    function applyMode() {
      if (body.classList.contains("elementor-editor-active")) return;
      var overlay = isHome && mq.matches;
      body.classList.toggle("higer-overlay", overlay);
      body.style.setProperty("padding-top", overlay ? "0px" : header.offsetHeight + "px", "important");
    }

    function checkScroll() {
      if (window.scrollY > threshold) {
        header.classList.add("is-scrolled");
      } else {
        header.classList.remove("is-scrolled");
      }
    }

    applyMode();
    checkScroll();
    window.addEventListener("scroll", checkScroll, { passive: true });
    window.addEventListener("resize", applyMode);
    window.addEventListener("load", applyMode);
    if (mq.addEventListener) mq.addEventListener("change", applyMode);
    if ("ResizeObserver" in window) new ResizeObserver(applyMode).observe(header);

    /* مگامنو دسکتاپ */
    var megaItem = header.querySelector(".hh-nav-item[data-has-mega]");
    if (megaItem) {
      var megaTimer = null;
      var megaLink = megaItem.querySelector(".hh-nav-link");
      function openMega() {
        clearTimeout(megaTimer);
        megaItem.classList.add("is-open");
        if (megaLink) megaLink.setAttribute("aria-expanded", "true");
      }
      function closeMega() {
        megaTimer = setTimeout(function () {
          megaItem.classList.remove("is-open");
          if (megaLink) megaLink.setAttribute("aria-expanded", "false");
        }, 150);
      }
      megaItem.addEventListener("mouseenter", openMega);
      megaItem.addEventListener("mouseleave", closeMega);
      megaItem.addEventListener("focusin", openMega);
      megaItem.addEventListener("focusout", function (e) {
        if (!megaItem.contains(e.relatedTarget)) closeMega();
      });
    }

    /* ================== قفل کامل زنجیره اسکرول هنگام باز بودن منوی کشویی / سبد خرید ================== */
    var backdrop = document.getElementById("hh-backdrop");
    var cartDrawer = document.getElementById("hh-cart-drawer");
    var mobDrawer = document.getElementById("hh-mob-drawer");
    var searchModal = document.getElementById("hh-search-modal");
    var searchInput = document.getElementById("hh-search-input");
    var panelOpen = false;
    var lastTouchY = 0;

    function findScrollBox(target) {
      if (!target || !target.closest) return null;
      return target.closest("[data-hh-scroll], .hh-mob-body, .hh-cart-list, .hh-search-results");
    }

    document.addEventListener("touchstart", function (e) {
      if (!panelOpen || !e.touches || !e.touches.length) return;
      lastTouchY = e.touches[0].clientY;
    }, { passive: true });

    document.addEventListener("touchmove", function (e) {
      if (!panelOpen || !e.touches || !e.touches.length) return;
      var box = findScrollBox(e.target);
      if (!box) {
        if (e.cancelable) e.preventDefault();
        return;
      }
      var canScroll = box.scrollHeight > box.clientHeight + 1;
      if (!canScroll) {
        if (e.cancelable) e.preventDefault();
        return;
      }
      var y = e.touches[0].clientY;
      var dy = lastTouchY - y;
      lastTouchY = y;
      var atTop = box.scrollTop <= 0;
      var atBottom = box.scrollTop + box.clientHeight >= box.scrollHeight - 1;
      if ((dy < 0 && atTop) || (dy > 0 && atBottom)) {
        if (e.cancelable) e.preventDefault();
      }
    }, { passive: false });

    document.addEventListener("wheel", function (e) {
      if (!panelOpen) return;
      var box = findScrollBox(e.target);
      if (!box) {
        if (e.cancelable) e.preventDefault();
        return;
      }
      var canScroll = box.scrollHeight > box.clientHeight + 1;
      if (!canScroll) {
        if (e.cancelable) e.preventDefault();
        return;
      }
      var dy = e.deltaY;
      var atTop = box.scrollTop <= 0;
      var atBottom = box.scrollTop + box.clientHeight >= box.scrollHeight - 1;
      if ((dy < 0 && atTop) || (dy > 0 && atBottom)) {
        if (e.cancelable) e.preventDefault();
      }
    }, { passive: false });

    function lockPageScroll(lock) {
      panelOpen = lock;
      docEl.classList.toggle("hh-scroll-lock", lock);
      body.classList.toggle("hh-scroll-lock", lock);
    }

    function closeAll() {
      if (backdrop) backdrop.classList.remove("is-open");
      if (cartDrawer) cartDrawer.classList.remove("is-open");
      if (mobDrawer) mobDrawer.classList.remove("is-open");
      if (searchModal) searchModal.classList.remove("is-open");
      lockPageScroll(false);
    }

    function openDrawer(el) {
      if (!el) return;
      closeAll();
      if (backdrop) backdrop.classList.add("is-open");
      el.classList.add("is-open");
      lockPageScroll(true);
    }

    function openSearch() {
      if (!searchModal) return;
      closeAll();
      searchModal.classList.add("is-open");
      lockPageScroll(true);
      setTimeout(function () { if (searchInput) searchInput.focus(); }, 80);
    }

    header.querySelectorAll("[data-hh-open]").forEach(function (btn) {
      btn.addEventListener("click", function () {
        var t = btn.getAttribute("data-hh-open");
        if (t === "cart") openDrawer(cartDrawer);
        else if (t === "mob") openDrawer(mobDrawer);
        else if (t === "search") openSearch();
      });
    });

    document.querySelectorAll("[data-hh-close]").forEach(function (btn) {
      btn.addEventListener("click", closeAll);
    });
    if (backdrop) backdrop.addEventListener("click", closeAll);
    if (searchModal) {
      searchModal.addEventListener("click", function (e) {
        if (e.target === searchModal) closeAll();
      });
    }
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeAll();
    });

    /* آکاردئون منوی موبایل */
    document.querySelectorAll("[data-hh-mob-acc]").forEach(function (btn) {
      btn.addEventListener("click", function () {
        var wrap = btn.closest(".hh-mob-acc");
        if (wrap) wrap.classList.toggle("is-open");
      });
    });

    /* باز شدن خودکار پنل سبد خرید هنگام افزودن محصول با AJAX ووکامرس */
    if (<?php echo $open_add; ?> && window.jQuery) {
      window.jQuery(document.body).on("added_to_cart", function () {
        openDrawer(cartDrawer);
      });
    }

    /* جستجوی زنده محصولات از WooCommerce Store API */
    var resultsBox = document.getElementById("hh-search-results");
    var apiBase = <?php echo wp_json_encode( $api_base ); ?>;
    var defaultHTML = resultsBox ? resultsBox.innerHTML : "";
    var timer = null;

    function faDigits(s) {
      return String(s).replace(/[0-9]/g, function (d) { return "۰۱۲۳۴۵۶۷۸۹"[d]; });
    }
    function formatPrice(p) {
      if (!p || !p.prices) return "";
      var minor = Math.pow(10, p.prices.currency_minor_unit || 0);
      var min = p.prices.price_range ? Number(p.prices.price_range.min_amount) / minor : Number(p.prices.price) / minor;
      if (!min || isNaN(min)) return "تماس بگیرید";
      return (p.prices.price_range ? "از " : "") + faDigits(Math.round(min).toLocaleString("en-US")) + " تومان";
    }

    function runSearch(q) {
      if (!resultsBox) return;
      q = (q || "").trim();
      if (q.length < 2) {
        resultsBox.innerHTML = defaultHTML;
        bindChips();
        return;
      }
      resultsBox.innerHTML = '<p class="hh-search-hint">در حال جستجو در مجموعه تشک‌های هیگر...</p>';
      fetch(apiBase + "?search=" + encodeURIComponent(q) + "&per_page=6")
        .then(function (r) { return r.json(); })
        .then(function (list) {
          if (!Array.isArray(list) || !list.length) {
            resultsBox.innerHTML = '<p class="hh-search-hint">مدلی با عبارت «' + q.replace(/</g, "&lt;") + '» یافت نشد.</p>';
            return;
          }
          var html = '<ul class="hh-search-list">';
          list.forEach(function (item) {
            var img = (item.images && item.images[0] && item.images[0].thumbnail) ? item.images[0].thumbnail : "";
            html += '<li class="hh-search-item"><a href="' + item.permalink + '">' +
              (img ? '<img class="hh-search-thumb" src="' + img + '" alt="" loading="lazy">' : '') +
              '<div><span class="hh-search-title">' + item.name + '</span><span class="hh-search-price">' + formatPrice(item) + '</span></div>' +
              '</a></li>';
          });
          html += '</ul>';
          resultsBox.innerHTML = html;
        })
        .catch(function () {
          resultsBox.innerHTML = '<p class="hh-search-hint">برای مشاهده نتایج کامل کلید Enter را بزنید.</p>';
        });
    }

    function bindChips() {
      if (!resultsBox || !searchInput) return;
      resultsBox.querySelectorAll("[data-hh-chip]").forEach(function (chip) {
        chip.addEventListener("click", function () {
          searchInput.value = chip.getAttribute("data-hh-chip");
          searchInput.focus();
          runSearch(searchInput.value);
        });
      });
    }
    bindChips();

    if (searchInput) {
      searchInput.addEventListener("input", function () {
        clearTimeout(timer);
        timer = setTimeout(function () { runSearch(searchInput.value); }, 260);
      });
    }
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
   بخش ۴ — خروجی HTML هدر و ثبت شورت‌کد [higer_header]
   ============================================================ */

if ( ! function_exists( 'higer_header_render' ) ) {
	function higer_header_render() {
		static $rendered = false;
		if ( $rendered ) {
			return '';
		}
		$rendered = true;

		$cfg      = higer_header_config();
		$logo_src = higer_header_logo_src( $cfg );
		$is_home  = ( function_exists( 'is_front_page' ) && is_front_page() ) || ( function_exists( 'is_home' ) && is_home() );
		$beh      = $cfg['behavior'];

		ob_start();
		echo higer_header_assets( $cfg ); // phpcs:ignore
		?>
<header class="higer-header" role="banner" data-is-home="<?php echo $is_home ? '1' : '0'; ?>">
	<div class="higer-glass" aria-hidden="true"></div>
	<div class="hh-bar">
		<!-- دکمه منوی موبایل: در موبایل سمت راست صفحه قرار می‌گیرد -->
		<button type="button" class="hh-burger" data-hh-open="mob" aria-label="باز کردن منو">
			<?php echo higer_header_icon( 'menu', 20 ); // phpcs:ignore ?>
		</button>

		<!-- امضای برند و لوگو: در موبایل دقیقاً وسط، در دسکتاپ سمت راست -->
		<div class="hh-brand-zone">
			<a href="<?php echo esc_url( $cfg['brand']['home_url'] ); ?>" class="hh-brand" aria-label="<?php echo esc_attr( $cfg['brand']['name'] ); ?>">
				<?php if ( $logo_src ) : ?>
					<img class="hh-logo-img" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( $cfg['brand']['name'] ); ?>" decoding="async" onerror="this.style.display='none';if(this.nextElementSibling)this.nextElementSibling.style.display='inline-flex';">
					<span class="hh-crest-fallback" style="<?php echo ! empty( $cfg['brand']['show_text_with_logo'] ) ? '' : 'display:none'; ?>">
						<span class="hh-crest-mark">H</span>
						<span class="hh-crest-text">
							<b><?php echo esc_html( $cfg['brand']['name'] ); ?></b>
							<small><?php echo esc_html( $cfg['brand']['en_name'] ); ?></small>
						</span>
					</span>
				<?php else : ?>
					<span class="hh-crest-fallback">
						<span class="hh-crest-mark">H</span>
						<span class="hh-crest-text">
							<b><?php echo esc_html( $cfg['brand']['name'] ); ?></b>
							<small><?php echo esc_html( $cfg['brand']['en_name'] ); ?></small>
						</span>
					</span>
				<?php endif; ?>
			</a>
			<?php if ( ! empty( $cfg['brand']['heritage'] ) ) : ?>
				<span class="hh-heritage"><?php echo esc_html( $cfg['brand']['heritage'] ); ?></span>
			<?php endif; ?>
		</div>

		<!-- ناوبری ادیتوریال دسکتاپ (در مرکز دسکتاپ) -->
		<nav class="hh-nav" aria-label="منوی اصلی تشک هیگر">
			<ul class="hh-nav-list">
				<?php foreach ( $cfg['nav'] as $item ) :
					$has_mega = ! empty( $item['mega'] );
					$active   = higer_header_is_active( $item['key'] );
					$cls      = 'hh-nav-link' . ( $active ? ' is-active' : '' ) . ( ! empty( $item['gem'] ) ? ' is-gem' : '' );
					?>
					<li class="hh-nav-item<?php echo $has_mega ? ' hh-mega-anchor' : ''; ?>"<?php echo $has_mega ? ' data-has-mega="1"' : ''; ?>>
						<a href="<?php echo esc_url( $item['url'] ); ?>" class="<?php echo esc_attr( $cls ); ?>"<?php echo $has_mega ? ' aria-haspopup="true" aria-expanded="false"' : ''; ?>>
							<?php if ( ! empty( $item['gem'] ) ) : ?>
								<span class="hh-gem-ico"><?php echo higer_header_icon( 'gem', 13 ); // phpcs:ignore ?></span>
							<?php endif; ?>
							<span><?php echo esc_html( $item['label'] ); ?></span>
							<?php if ( $has_mega ) : ?>
								<span class="hh-caret"><?php echo higer_header_icon( 'chevron', 14 ); // phpcs:ignore ?></span>
							<?php endif; ?>
						</a>

						<?php if ( $has_mega ) : ?>
							<div class="hh-mega" role="region" aria-label="مجموعه محصولات تشک هیگر">
								<div class="hh-mega-layout">
									<!-- ستون ۱: ۴ فناوری هسته تشک با دیاگرام فنی -->
									<div>
										<div class="hh-mega-eyebrow">
											<span>چهار ساختار مهندسی هسته تشک</span>
											<a href="<?php echo esc_url( $cfg['urls']['shop'] ); ?>" class="hh-mega-viewall">
												<span>همه محصولات فروشگاه</span>
												<?php echo higer_header_icon( 'arrow-l', 13 ); // phpcs:ignore ?>
											</a>
										</div>
										<div class="hh-mega-cores">
											<?php foreach ( $cfg['mega_cores'] as $core ) : ?>
												<a href="<?php echo esc_url( $core['url'] ); ?>" class="hh-core-card">
													<div class="hh-core-head">
														<?php echo higer_header_core_svg( $core['key'] ); // phpcs:ignore ?>
														<span class="hh-core-num"><?php echo esc_html( $core['num'] ); ?></span>
													</div>
													<div>
														<span class="hh-core-title"><?php echo esc_html( $core['title'] ); ?></span>
														<span class="hh-core-en"><?php echo esc_html( $core['en'] ); ?></span>
													</div>
													<span class="hh-core-models"><?php echo esc_html( $core['models'] ); ?></span>
												</a>
											<?php endforeach; ?>
										</div>
									</div>

									<!-- ستون ۲: کالای خواب مکمل -->
									<div class="hh-mega-col-mid">
										<div class="hh-mega-eyebrow"><span>کالای خواب مکمل</span></div>
										<div class="hh-side-list">
											<?php foreach ( $cfg['mega_side'] as $acc ) : ?>
												<a href="<?php echo esc_url( $acc['url'] ); ?>" class="hh-side-item">
													<strong><?php echo esc_html( $acc['title'] ); ?></strong>
													<span><?php echo esc_html( $acc['sub'] ); ?></span>
												</a>
											<?php endforeach; ?>
										</div>
									</div>

									<!-- ستون ۳: مشاور هوشمند خواب -->
									<div class="hh-mega-concierge">
										<div>
											<span class="hh-concierge-badge">
												<?php echo higer_header_icon( 'moon', 12 ); // phpcs:ignore ?>
												<span>تشک‌سنج هوشمند هیگر</span>
											</span>
											<h4>کدام تشک دقیقاً مناسب آناتومی بدن شماست؟</h4>
											<p>با پاسخ به ۵ پرسش کوتاه درباره وزن، قد و حالت خواب، مناسب‌ترین مدل‌ها از میان تولیدات هیگر پیشنهاد می‌شوند.</p>
										</div>
										<a href="<?php echo esc_url( $cfg['urls']['finder'] ); ?>" class="hh-btn-gold hh-full">
											<span>شروع تشک‌سنج هوشمند</span>
											<?php echo higer_header_icon( 'arrow-l', 14 ); // phpcs:ignore ?>
										</a>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<!-- ابزارهای سمت چپ (جستجو، حساب کاربری، سبد خرید) -->
		<div class="hh-actions">
			<?php if ( ! empty( $beh['show_phone'] ) ) : ?>
				<a href="<?php echo esc_url( $cfg['store']['tel'] ); ?>" class="hh-tel-link" aria-label="تماس مستقیم با مشاور فروش هیگر">
					<span class="hh-tel-ring"><?php echo higer_header_icon( 'phone', 13 ); // phpcs:ignore ?></span>
					<span class="hh-tel-num"><?php echo esc_html( $cfg['store']['phone'] ); ?></span>
				</a>
				<span class="hh-sep" aria-hidden="true"></span>
			<?php endif; ?>

			<div class="hh-capsule">
				<?php if ( ! empty( $beh['show_search'] ) ) : ?>
					<button type="button" class="hh-cap-btn" data-hh-open="search" aria-label="جستجوی محصولات">
						<?php echo higer_header_icon( 'search', 17 ); // phpcs:ignore ?>
					</button>
				<?php endif; ?>

				<?php if ( ! empty( $beh['show_account'] ) ) : ?>
					<a href="<?php echo esc_url( $cfg['urls']['account'] ); ?>" class="hh-cap-btn hh-cap-account" aria-label="حساب کاربری">
						<?php echo higer_header_icon( 'user', 17 ); // phpcs:ignore ?>
					</a>
				<?php endif; ?>

				<?php if ( ! empty( $beh['show_cart'] ) ) : ?>
					<button type="button" class="hh-cart-pill" data-hh-open="cart" aria-label="سبد خرید">
						<?php echo higer_header_icon( 'bag', 16 ); // phpcs:ignore ?>
						<?php echo higer_header_render_cart_badge(); // phpcs:ignore ?>
					</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>

<div class="hh-backdrop" id="hh-backdrop" aria-hidden="true"></div>

<?php if ( ! empty( $beh['show_cart'] ) ) : ?>
<aside class="hh-drawer hh-drawer-left" id="hh-cart-drawer" role="dialog" aria-modal="true" aria-label="سبد خرید">
	<div class="hh-drawer-head">
		<p class="hh-drawer-title">
			<?php echo higer_header_icon( 'bag', 17 ); // phpcs:ignore ?>
			<span>سبد خرید شما</span>
		</p>
		<button type="button" class="hh-close-btn" data-hh-close aria-label="بستن سبد خرید">
			<?php echo higer_header_icon( 'close', 16 ); // phpcs:ignore ?>
		</button>
	</div>
	<?php echo higer_header_render_cart_body(); // phpcs:ignore ?>
</aside>
<?php endif; ?>

<aside class="hh-drawer hh-drawer-right" id="hh-mob-drawer" role="dialog" aria-modal="true" aria-label="منوی موبایل">
	<div class="hh-drawer-head">
		<?php if ( $logo_src ) : ?>
			<a href="<?php echo esc_url( $cfg['brand']['home_url'] ); ?>" aria-label="<?php echo esc_attr( $cfg['brand']['name'] ); ?>">
				<img class="hh-drawer-logo" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( $cfg['brand']['name'] ); ?>" decoding="async">
			</a>
		<?php else : ?>
			<p class="hh-drawer-title"><span><?php echo esc_html( $cfg['brand']['name'] ); ?></span></p>
		<?php endif; ?>
		<button type="button" class="hh-close-btn" data-hh-close aria-label="بستن منو">
			<?php echo higer_header_icon( 'close', 16 ); // phpcs:ignore ?>
		</button>
	</div>
	<div class="hh-mob-body" data-hh-scroll>
		<?php foreach ( $cfg['nav'] as $item ) :
			$active = higer_header_is_active( $item['key'] );
			$cls    = 'hh-mob-link' . ( $active ? ' is-active' : '' ) . ( ! empty( $item['gem'] ) ? ' is-gem' : '' );
			if ( ! empty( $item['mega'] ) ) : ?>
				<div class="hh-mob-acc is-open">
					<button type="button" class="<?php echo esc_attr( $cls ); ?>" data-hh-mob-acc>
						<span><?php echo esc_html( $item['label'] ); ?></span>
						<span class="hh-caret"><?php echo higer_header_icon( 'chevron', 16 ); // phpcs:ignore ?></span>
					</button>
					<div class="hh-mob-sub">
						<a href="<?php echo esc_url( $cfg['urls']['shop'] ); ?>"><span>مشاهده همه محصولات فروشگاه</span><?php echo higer_header_icon( 'arrow-l', 13 ); // phpcs:ignore ?></a>
						<?php foreach ( $cfg['mega_cores'] as $core ) : ?>
							<a href="<?php echo esc_url( $core['url'] ); ?>"><span>تشک <?php echo esc_html( $core['title'] ); ?></span></a>
						<?php endforeach; ?>
						<?php foreach ( $cfg['mega_side'] as $acc ) : ?>
							<a href="<?php echo esc_url( $acc['url'] ); ?>"><span><?php echo esc_html( $acc['title'] ); ?></span></a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php else : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>" class="<?php echo esc_attr( $cls ); ?>">
					<span><?php echo esc_html( $item['label'] ); ?></span>
					<?php if ( ! empty( $item['gem'] ) ) echo higer_header_icon( 'gem', 14 ); // phpcs:ignore ?>
				</a>
			<?php endif;
		endforeach; ?>
	</div>
	<div class="hh-mob-foot">
		<a href="<?php echo esc_url( $cfg['store']['tel'] ); ?>" class="hh-btn-gold hh-full">
			<?php echo higer_header_icon( 'phone', 15 ); // phpcs:ignore ?>
			<span>مشاوره و سفارش — <?php echo esc_html( $cfg['store']['phone'] ); ?></span>
		</a>
		<a href="<?php echo esc_url( $cfg['urls']['account'] ); ?>" class="hh-btn-outline hh-full">
			<?php echo higer_header_icon( 'user', 15 ); // phpcs:ignore ?>
			<span>حساب کاربری و پیگیری سفارش</span>
		</a>
		<?php
		$hh_socials = array();
		foreach ( ( isset( $cfg['socials'] ) ? (array) $cfg['socials'] : array() ) as $hh_soc ) {
			if ( ! empty( $hh_soc['url'] ) ) {
				$hh_socials[] = $hh_soc;
			}
		}
		if ( $hh_socials ) : ?>
		<div class="hh-mob-social">
			<span class="hh-mob-social-cap">گفتگو و همراهی با هیگر</span>
			<div class="hh-mob-social-links">
				<?php foreach ( $hh_socials as $hh_soc ) : ?>
					<a class="hh-social-dot" href="<?php echo esc_url( $hh_soc['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $hh_soc['label'] . ' ' . $cfg['brand']['name'] ); ?>" title="<?php echo esc_attr( $hh_soc['label'] ); ?>">
						<?php echo higer_header_icon( $hh_soc['key'], 17 ); // phpcs:ignore ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</aside>

<?php if ( ! empty( $beh['show_search'] ) ) : ?>
<div class="hh-search-modal" id="hh-search-modal" role="dialog" aria-modal="true" aria-label="جستجوی محصولات هیگر">
	<div class="hh-search-box">
		<form class="hh-search-form" role="search" method="get" action="<?php echo esc_url( $cfg['brand']['home_url'] ); ?>">
			<?php echo higer_header_icon( 'search', 19 ); // phpcs:ignore ?>
			<input type="hidden" name="post_type" value="product">
			<input type="search" name="s" id="hh-search-input" class="hh-search-input" placeholder="جستجوی نام مدل... مثلاً الدورادو، آمستردام، راینو، تاپر" autocomplete="off">
			<button type="button" class="hh-close-btn" data-hh-close aria-label="بستن جستجو">
				<?php echo higer_header_icon( 'close', 15 ); // phpcs:ignore ?>
			</button>
		</form>
		<div class="hh-search-results" id="hh-search-results" data-hh-scroll>
			<p class="hh-search-hint">مدل‌های پرطرفدار تشک و کالای خواب هیگر:</p>
			<div class="hh-search-chips">
				<button type="button" class="hh-search-chip" data-hh-chip="الدورادو">الدورادو سوپرلوکس</button>
				<button type="button" class="hh-search-chip" data-hh-chip="آمستردام">آمستردام</button>
				<button type="button" class="hh-search-chip" data-hh-chip="راینو">راینو طبی</button>
				<button type="button" class="hh-search-chip" data-hh-chip="کوئین">کوئین پلاس</button>
				<button type="button" class="hh-search-chip" data-hh-chip="تاپر">تاپر تشک</button>
				<button type="button" class="hh-search-chip" data-hh-chip="محافظ">محافظ تشک</button>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
		<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_header' ) ) {
	add_shortcode( 'higer_header', 'higer_header_render' );
}

if ( function_exists( 'add_action' ) ) {
	add_action( 'wp_body_open', function () {
		$cfg = higer_header_config();
		if ( ! empty( $cfg['behavior']['auto_inject'] ) ) {
			echo higer_header_render(); // phpcs:ignore
		}
	}, 5 );
}
