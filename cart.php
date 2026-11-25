<?php
/**
 * Higer Cart — صفحه «سبد خرید» تشک هیگر | نسخه بدون بیلد (v1.0)
 * =====================================================================
 * اسنیپت PHP مستقل برای افزونه WPCode، طراحی‌شده دقیقاً هم‌خانواده با
 * Home Page.php، Shop Page.php، Single Product Page.php و هدر/فوتر هیگر.
 *
 * ─── نصب در WPCode (۲ دقیقه) ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل همین فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *     (حتماً Run Everywhere؛ چون به‌روزرسانی آنی سبد از admin-ajax.php استفاده می‌کند)
 *  ۴. Save و Activate
 *
 * ─── نمایش در برگه «سبد خرید» (/my-cart/) ───
 *  با المنتور: وارد ویرایش برگه «سبد خرید» شوید، ویجت پیش‌فرض سبد خرید و تیتر
 *  قدیمی را حذف کنید و یک ویجت Shortcode در یک کانتینر تمام‌عرض بگذارید:
 *      [higer_cart]
 *  بدون المنتور: در بخش تنظیمات پایین 'auto_content' را true کنید تا محتوای
 *  برگه سبد خرید ووکامرس به‌طور خودکار جایگزین شود.
 *
 * ─── شورت‌کدها ───
 *  [higer_cart]                   نمایش کامل سبد خرید
 *  [higer_cart cross_sells="no"]  بدون بخش پیشنهاد محصولات مکمل
 *  [higer_cart fullwidth="no"]    بدون کشیدگی تمام‌عرض
 *
 * ─── امکانات یکپارچه ───
 *  • تغییر تعداد، حذف آیتم، خالی کردن سبد و ثبت/حذف کد تخفیف به‌صورت آنی (AJAX)
 *  • همگام‌سازی زنده نشان عدد سبد و پنل کشویی مینی‌کارت در Header.php بدون رفرش
 *  • نمایش دقیق سایز انتخاب‌شده و ویژگی‌های متغیر هر تشک با ارقام فارسی
 *  • پشتیبانی کامل از حالت بدون جاوااسکریپت (ارسال استاندارد فرم ووکامرس)
 *  • حالت سبد خالی هوشمند همراه با ۴ هسته تشک، لینک تشک‌سنج و محصولات پیشنهادی
 *  • نوار چسبنده تسویه حساب در موبایل + ثبت سفارش یا مشاوره سریع در واتساپ
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_cart_config' ) ) :
function higer_cart_config() {
	$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';
	$chk  = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : rtrim( $home, '/' ) . '/checkout/';

	return array(
		/* --- فروشگاه و پشتیبانی خرید --- */
		'store' => array(
			'name'         => 'تشک هیگر',
			'phone'        => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'          => 'tel:+989111186485',
			'whatsapp_num' => '989111186485', // بدون صفر و + برای ساخت خودکار لینک واتساپ همراه با خلاصه سبد
			'hours'        => 'همه‌روزه به‌جز روزهای تعطیل، ساعت ۹ الی ۲۱',
		),

		/* --- لینک‌های کلیدی --- */
		'urls' => array(
			'home'     => $home,
			'shop'     => $shop,
			'checkout' => $chk,
			'finder'   => rtrim( $home, '/' ) . '/#hg-finder',
		),

		/* --- رفتار اسنیپت --- */
		'behavior' => array(
			'auto_content'        => false,     // true = جایگزینی خودکار محتوای برگه سبد خرید بدون المنتور
			'page_slug'           => 'my-cart', // نامک برگه سبد خرید در سایت
			'show_cross_sells'    => true,      // نمایش پیشنهاد مکمل (مثل تاپر و محافظ تشک)
			'cross_sell_limit'    => 4,         // حداکثر تعداد محصولات پیشنهادی
			'fallback_cat_slug'   => 'accessories', // اگر محصول مکمل دستی ثبت نشده بود، از این دسته پیشنهاد بده
			'show_coupons'        => true,      // نمایش کادر کد تخفیف (در صورت فعال بودن کوپن در ووکامرس)
			'show_whatsapp_help'  => true,      // دکمه ارسال سبد به واتساپ برای مشاوره قبل از پرداخت
			'suppress_footer_cta' => true,      // پنهان‌کردن بنر مشاوره Footer.php در صفحه سبد خرید
		),

		/* --- متن‌های سربرگ و مراحل خرید --- */
		'hero' => array(
			'kicker'   => 'سبد خرید و بررسی سفارش',
			'title_a'  => 'سبد خرید ',
			'title_b'  => 'شما',
			'subtitle' => 'سایز و تعداد اقلام انتخابی خود را بررسی کنید و برای ثبت نهایی سفارش وارد مرحله تسویه حساب شوید.',
			'steps'    => array(
				array( 'num' => '۱', 'label' => 'سبد خرید',            'state' => 'current' ),
				array( 'num' => '۲', 'label' => 'اطلاعات و تسویه حساب', 'state' => 'next', 'url' => $chk ),
				array( 'num' => '۳', 'label' => 'ثبت نهایی و فاکتور',   'state' => 'upcoming' ),
			),
		),

		/* --- یادداشت ارسال و تضمین‌های زیر خلاصه سفارش --- */
		'shipping_note' => 'هزینه و زمان دقیق ارسال بر اساس شهر مقصد و ابعاد تشک در مرحله تسویه حساب یا هماهنگی تلفنی محاسبه می‌شود.',
		'assurances'    => array(
			array( 'icon' => 'shield', 'title' => 'ضمانت معتبر هیگر',     'sub' => 'شروع گارانتی از تاریخ ثبت فاکتور' ),
			array( 'icon' => 'lock',   'title' => 'پرداخت امن و منعطف',   'sub' => 'درگاه رسمی بانکی یا کارت‌به‌کارت' ),
			array( 'icon' => 'truck',  'title' => 'بسته‌بندی ایمن کارخانه', 'sub' => 'ارسال هماهنگ‌شده به سراسر کشور' ),
		),

		/* --- حالت سبد خالی: میان‌بر ۴ هسته تشک --- */
		'empty' => array(
			'title'    => 'سبد خرید شما در حال حاضر خالی است',
			'subtitle' => 'می‌توانید از میان تشک‌های فنری و طبی هیگر مدل مناسب خود را انتخاب کنید یا با تشک‌سنج هوشمند در کمتر از یک دقیقه بهترین گزینه‌ها را ببینید.',
			'cores'    => array(
				array( 'num' => '۰۱', 'title' => 'تشک فنر متصل',   'sub' => 'کانگورو، اکونومیک، روکسانا، همر', 'url' => rtrim( $home, '/' ) . '/product-category/mattress/spring/bonnell-spring/' ),
				array( 'num' => '۰۲', 'title' => 'تشک فنر منفصل',  'sub' => 'الدورادو سوپرلوکس • پاکتی مستقل', 'url' => rtrim( $home, '/' ) . '/product-category/mattress/spring/pocket-spring/' ),
				array( 'num' => '۰۳', 'title' => 'تشک ریباند طبی',  'sub' => 'راینو، رومانس • بدون فنر مستحکم', 'url' => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/rebound/' ),
				array( 'num' => '۰۴', 'title' => 'تشک فوم سنگین',  'sub' => 'نایت، کوئین، اومئا، آوینا، هلسا', 'url' => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/high-density-foam/' ),
			),
		),

		/* --- برچسب کاربردی سایزها --- */
		'size_labels' => array(
			'70x130'  => 'نوزاد',
			'80x180'  => 'نوجوان',
			'90x200'  => 'یک‌نفره',
			'100x200' => 'یک‌نفره',
			'120x200' => 'یک‌نفره عریض',
			'140x200' => 'دونفره',
			'160x200' => 'کویین',
			'180x200' => 'کینگ',
			'200x200' => 'سوپرکینگ',
		),
	);
}
endif;

/* ============================================================
   بخش ۲ — توابع کمکی، فرمت ارقام و موتور AJAX سبد خرید
   ============================================================ */

if ( ! function_exists( 'higer_cart_fa' ) ) {
	function higer_cart_fa( $text ) {
		return strtr( (string) $text, array(
			'0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
			'5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
		) );
	}
}

if ( ! function_exists( 'higer_cart_en_digits' ) ) {
	function higer_cart_en_digits( $text ) {
		return strtr( (string) $text, array(
			'۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
			'۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
			'٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
			'٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
		) );
	}
}

if ( ! function_exists( 'higer_cart_money_fa' ) ) {
	function higer_cart_money_fa( $html ) {
		return higer_cart_fa( wp_kses_post( (string) $html ) );
	}
}

if ( ! function_exists( 'higer_cart_icon' ) ) {
	function higer_cart_icon( $name, $size = 18 ) {
		$icons = array(
			'bag'      => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
			'trash'    => '<path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>',
			'plus'     => '<path d="M12 5v14"/><path d="M5 12h14"/>',
			'minus'    => '<path d="M5 12h14"/>',
			'tag'      => '<path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"/><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"/>',
			'shield'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/>',
			'lock'     => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
			'truck'    => '<path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>',
			'arrow-l'  => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'arrow-r'  => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
			'check'    => '<path d="M20 6 9 17l-5-5"/>',
			'moon'     => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
			'phone'    => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'whatsapp' => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
			'ruler'    => '<path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/>',
			'refresh'  => '<path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/><path d="M3 21v-5h5"/>',
			'close'    => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
			'spark'    => '<path d="M12 3l2.4 5.6L20 11l-5.6 2.4L12 19l-2.4-5.6L4 11l5.6-2.4L12 3z"/>',
		);
		$path = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
		return '<svg class="hkr-i" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* استخراج ویژگی‌های خوانا (مثل سایز ۱۶۰×۲۰۰) برای هر ردیف سبد */
if ( ! function_exists( 'higer_cart_item_badges' ) ) {
	function higer_cart_item_badges( $cart_item, $product, $cfg ) {
		$badges = array();
		if ( ! empty( $cart_item['variation'] ) && is_array( $cart_item['variation'] ) ) {
			foreach ( $cart_item['variation'] as $attr_key => $attr_val ) {
				if ( '' === (string) $attr_val ) {
					continue;
				}
				$taxonomy = str_replace( 'attribute_', '', $attr_key );
				$label    = function_exists( 'wc_attribute_label' ) ? wc_attribute_label( $taxonomy, $product ) : $taxonomy;
				$val_text = $attr_val;
				if ( taxonomy_exists( $taxonomy ) ) {
					$term = get_term_by( 'slug', $attr_val, $taxonomy );
					if ( $term && ! is_wp_error( $term ) ) {
						$val_text = $term->name;
					}
				} else {
					$val_text = rawurldecode( (string) $attr_val );
				}
				$norm_slug = strtolower( str_replace( array( ' ', '×', '*' ), 'x', higer_cart_en_digits( $attr_val ) ) );
				if ( isset( $cfg['size_labels'][ $norm_slug ] ) && false === strpos( $val_text, $cfg['size_labels'][ $norm_slug ] ) ) {
					$val_text .= ' (' . $cfg['size_labels'][ $norm_slug ] . ')';
				}
				$val_text = str_replace( array( 'x', 'X', '*' ), '×', $val_text );
				$badges[] = array(
					'label' => $label,
					'value' => higer_cart_fa( $val_text ),
				);
			}
		}

		/* نمایش گارانتی ثبت‌شده روی محصول والد (در صورت وجود) */
		$parent_id = $product->get_parent_id() ? $product->get_parent_id() : $product->get_id();
		$parent    = $parent_id ? wc_get_product( $parent_id ) : $product;
		if ( $parent ) {
			$warranty = $parent->get_attribute( 'pa_warranty' );
			if ( '' !== trim( (string) $warranty ) ) {
				$badges[] = array(
					'label' => 'گارانتی',
					'value' => higer_cart_fa( $warranty ),
				);
			}
		}
		return $badges;
	}
}

/* جمع‌آوری محصولات مکمل (Cross-Sells یا محصولات جانبی مثل تاپر و محافظ) */
if ( ! function_exists( 'higer_cart_collect_suggestions' ) ) {
	function higer_cart_collect_suggestions( $cart, $cfg, $for_empty = false ) {
		if ( ! function_exists( 'wc_get_product' ) || ! function_exists( 'wc_get_products' ) ) {
			return array();
		}
		$limit   = isset( $cfg['behavior']['cross_sell_limit'] ) ? max( 1, (int) $cfg['behavior']['cross_sell_limit'] ) : 4;
		$in_cart = array();
		if ( $cart ) {
			foreach ( $cart->get_cart() as $ci ) {
				if ( ! empty( $ci['product_id'] ) ) {
					$in_cart[] = (int) $ci['product_id'];
				}
			}
		}

		$ids = array();
		if ( ! $for_empty && $cart ) {
			$ids = array_map( 'intval', (array) $cart->get_cross_sells() );
		}

		if ( count( $ids ) < $limit ) {
			$query_args = array(
				'status'       => 'publish',
				'limit'        => $limit + count( $in_cart ) + 4,
				'stock_status' => 'instock',
				'return'       => 'ids',
			);
			if ( ! $for_empty && ! empty( $cfg['behavior']['fallback_cat_slug'] ) ) {
				$query_args['category'] = array( $cfg['behavior']['fallback_cat_slug'] );
			}
			$extra = wc_get_products( $query_args );
			if ( empty( $extra ) && ! $for_empty ) {
				unset( $query_args['category'] );
				$extra = wc_get_products( $query_args );
			}
			$ids = array_values( array_unique( array_merge( $ids, array_map( 'intval', (array) $extra ) ) ) );
		}

		$items = array();
		foreach ( $ids as $pid ) {
			if ( in_array( $pid, $in_cart, true ) ) {
				continue;
			}
			$p = wc_get_product( $pid );
			if ( ! $p || ! $p->is_visible() || ! $p->is_in_stock() ) {
				continue;
			}
			$items[] = $p;
			if ( count( $items ) >= $limit ) {
				break;
			}
		}
		return $items;
	}
}

/* رندر داخلی بدنه سبد خرید (هم در بارگذاری اولیه و هم در پاسخ AJAX استفاده می‌شود) */
if ( ! function_exists( 'higer_cart_render_inner' ) ) {
	function higer_cart_render_inner( $cfg, $show_cross = true ) {
		if ( ! function_exists( 'WC' ) ) {
			return '<div class="hkr-card"><p>ووکامرس در حال حاضر فعال نیست.</p></div>';
		}
		if ( null === WC()->cart && function_exists( 'wc_load_cart' ) ) {
			wc_load_cart();
		}
		$cart = WC()->cart;
		if ( ! $cart ) {
			return '';
		}

		$cart->calculate_totals();
		$items      = $cart->get_cart();
		$count      = (int) $cart->get_cart_contents_count();
		$store      = $cfg['store'];
		$urls       = $cfg['urls'];
		$beh        = $cfg['behavior'];
		$cart_url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/my-cart/' );
		$chk_url    = $urls['checkout'];
		$coupons_ok = ! empty( $beh['show_coupons'] ) && function_exists( 'wc_coupons_enabled' ) && wc_coupons_enabled();

		ob_start();

		/* ─── حالت ۱: سبد خرید خالی ─── */
		if ( empty( $items ) ) :
			$featured = higer_cart_collect_suggestions( $cart, $cfg, true );
			?>
			<div class="hkr-empty-card">
				<span class="hkr-empty-ring"><?php echo higer_cart_icon( 'bag', 30 ); // phpcs:ignore ?></span>
				<h2><?php echo esc_html( $cfg['empty']['title'] ); ?></h2>
				<p><?php echo esc_html( $cfg['empty']['subtitle'] ); ?></p>
				<div class="hkr-empty-btns">
					<a class="hkr-btn-gold" href="<?php echo esc_url( $urls['shop'] ); ?>">
						<?php echo higer_cart_icon( 'bag', 16 ); // phpcs:ignore ?>
						<span>ورود به فروشگاه هیگر</span>
					</a>
					<a class="hkr-btn-dark" href="<?php echo esc_url( $urls['finder'] ); ?>">
						<?php echo higer_cart_icon( 'moon', 15 ); // phpcs:ignore ?>
						<span>شروع تشک‌سنج هوشمند</span>
					</a>
				</div>

				<?php if ( ! empty( $cfg['empty']['cores'] ) ) : ?>
				<div class="hkr-empty-cores">
					<?php foreach ( (array) $cfg['empty']['cores'] as $c ) : ?>
						<a class="hkr-empty-core" href="<?php echo esc_url( $c['url'] ); ?>">
							<span class="hkr-core-num"><?php echo esc_html( $c['num'] ); ?></span>
							<div>
								<b><?php echo esc_html( $c['title'] ); ?></b>
								<small><?php echo esc_html( $c['sub'] ); ?></small>
							</div>
							<?php echo str_replace( 'class="hkr-i"', 'class="hkr-i hkr-core-arr"', higer_cart_icon( 'arrow-l', 15 ) ); // phpcs:ignore ?>
						</a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $featured ) ) : ?>
			<section class="hkr-suggest">
				<div class="hkr-suggest-head">
					<div>
						<span class="hkr-kicker"><?php echo higer_cart_icon( 'spark', 12 ); // phpcs:ignore ?> پیشنهاد فروشگاه</span>
						<h3>محصولات آماده سفارش هیگر</h3>
					</div>
					<a class="hkr-link-more" href="<?php echo esc_url( $urls['shop'] ); ?>">مشاهده همه <?php echo higer_cart_icon( 'arrow-l', 14 ); // phpcs:ignore ?></a>
				</div>
				<div class="hkr-suggest-grid">
					<?php foreach ( $featured as $sp ) :
						$s_link = $sp->get_permalink();
						$s_img  = $sp->get_image( 'woocommerce_thumbnail' );
						$s_min  = (float) $sp->get_price();
						?>
						<a class="hkr-s-card" href="<?php echo esc_url( $s_link ); ?>">
							<div class="hkr-s-thumb"><?php echo wp_kses_post( $s_img ); ?></div>
							<div class="hkr-s-body">
								<b><?php echo esc_html( $sp->get_name() ); ?></b>
								<span><?php echo $s_min > 0 ? ( $sp->is_type( 'variable' ) ? 'از ' : '' ) . higer_cart_money_fa( wc_price( $s_min ) ) : 'مشاهده جزئیات'; // phpcs:ignore ?></span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</section>
			<?php endif; ?>
			<?php
			return (string) ob_get_clean();
		endif;

		/* ─── حالت ۲: سبد خرید دارای محصول ─── */
		$wa_lines = array( 'سلام، درباره این اقلام در سبد خریدم از سایت تشک هیگر راهنمایی می‌خواستم:' );
		?>
		<div class="hkr-grid">
			<!-- ستون راست: لیست اقلام سبد خرید -->
			<div class="hkr-items-col">
				<form class="woocommerce-cart-form hkr-cart-form" action="<?php echo esc_url( $cart_url ); ?>" method="post" data-hkr-form>
					<div class="hkr-list-head">
						<div class="hkr-list-title">
							<?php echo higer_cart_icon( 'bag', 18 ); // phpcs:ignore ?>
							<h2>اقلام انتخابی شما <span>(<?php echo esc_html( higer_cart_fa( $count ) ); ?> کالا)</span></h2>
						</div>
						<button type="button" class="hkr-clear-btn" data-hkr-clear>
							<?php echo higer_cart_icon( 'trash', 14 ); // phpcs:ignore ?>
							<span>خالی کردن سبد</span>
						</button>
					</div>

					<div class="hkr-item-list">
						<?php foreach ( $items as $cart_item_key => $cart_item ) :
							$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) {
								continue;
							}
							if ( ! apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								continue;
							}

							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
							$parent_p   = $_product->get_parent_id() ? wc_get_product( $_product->get_parent_id() ) : $_product;
							$title      = $parent_p ? $parent_p->get_name() : $_product->get_name();
							$permalink  = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
							$thumbnail  = $_product->get_image( 'woocommerce_thumbnail' );
							$unit_price = $cart->get_product_price( $_product );
							$subtotal   = $cart->get_product_subtotal( $_product, $cart_item['quantity'] );
							$qty        = (int) $cart_item['quantity'];
							$sold_ind   = $_product->is_sold_individually();
							$min_qty    = 0;
							$max_qty    = $_product->get_max_purchase_quantity();
							$remove_url = function_exists( 'wc_get_cart_remove_url' ) ? wc_get_cart_remove_url( $cart_item_key ) : '#';
							$badges     = higer_cart_item_badges( $cart_item, $_product, $cfg );
							$item_data  = function_exists( 'wc_get_formatted_cart_item_data' ) ? wc_get_formatted_cart_item_data( $cart_item, true ) : '';

							$badge_summary = array();
							foreach ( $badges as $b ) {
								$badge_summary[] = $b['label'] . ': ' . $b['value'];
							}
							$wa_lines[] = '• ' . $title . ( $badge_summary ? ' (' . implode( '، ', $badge_summary ) . ')' : '' ) . ' × ' . higer_cart_fa( $qty );
							?>
							<article class="hkr-item" data-hkr-item="<?php echo esc_attr( $cart_item_key ); ?>" data-product-id="<?php echo (int) $product_id; ?>">
								<div class="hkr-item-thumb">
									<?php if ( $permalink ) : ?><a href="<?php echo esc_url( $permalink ); ?>"><?php endif; ?>
										<?php echo wp_kses_post( $thumbnail ); ?>
									<?php if ( $permalink ) : ?></a><?php endif; ?>
								</div>

								<div class="hkr-item-main">
									<div class="hkr-item-top">
										<div>
											<?php if ( $permalink ) : ?>
												<a class="hkr-item-title" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
											<?php else : ?>
												<span class="hkr-item-title"><?php echo esc_html( $title ); ?></span>
											<?php endif; ?>

											<?php if ( ! empty( $badges ) ) : ?>
												<div class="hkr-item-badges">
													<?php foreach ( $badges as $b ) : ?>
														<span class="hkr-badge">
															<small><?php echo esc_html( $b['label'] ); ?>:</small>
															<b><?php echo esc_html( $b['value'] ); ?></b>
														</span>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>

											<?php if ( '' !== trim( (string) $item_data ) ) : ?>
												<div class="hkr-item-extra"><?php echo wp_kses_post( higer_cart_fa( $item_data ) ); ?></div>
											<?php endif; ?>
										</div>

										<a href="<?php echo esc_url( $remove_url ); ?>" class="hkr-remove" data-hkr-remove="<?php echo esc_attr( $cart_item_key ); ?>" aria-label="<?php echo esc_attr( 'حذف ' . $title . ' از سبد خرید' ); ?>" title="حذف این کالا">
											<?php echo higer_cart_icon( 'trash', 15 ); // phpcs:ignore ?>
										</a>
									</div>

									<div class="hkr-item-foot">
										<div class="hkr-unit">
											<small>قیمت واحد</small>
											<span><?php echo higer_cart_money_fa( $unit_price ); // phpcs:ignore ?></span>
										</div>

										<?php if ( $sold_ind ) : ?>
											<span class="hkr-qty-single">تعداد: ۱ عدد</span>
											<input type="hidden" name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]" value="1">
										<?php else : ?>
											<div class="hkr-qty" data-hkr-qty-wrap>
												<button type="button" class="hkr-qty-btn" data-hkr-step="-1" aria-label="کاهش تعداد"><?php echo higer_cart_icon( 'minus', 14 ); // phpcs:ignore ?></button>
												<input
													type="number"
													class="hkr-qty-input"
													name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
													value="<?php echo (int) $qty; ?>"
													min="<?php echo (int) $min_qty; ?>"
													<?php if ( $max_qty > 0 ) : ?>max="<?php echo (int) $max_qty; ?>"<?php endif; ?>
													step="1"
													inputmode="numeric"
													data-hkr-qty="<?php echo esc_attr( $cart_item_key ); ?>"
													aria-label="تعداد"
												>
												<button type="button" class="hkr-qty-btn" data-hkr-step="1"<?php echo ( $max_qty > 0 && $qty >= $max_qty ) ? ' disabled' : ''; ?> aria-label="افزایش تعداد"><?php echo higer_cart_icon( 'plus', 14 ); // phpcs:ignore ?></button>
											</div>
										<?php endif; ?>

										<div class="hkr-line-total">
											<small>جمع ردیف</small>
											<strong><?php echo higer_cart_money_fa( $subtotal ); // phpcs:ignore ?></strong>
										</div>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>

					<div class="hkr-form-bar">
						<a class="hkr-back-shop" href="<?php echo esc_url( $urls['shop'] ); ?>">
							<?php echo higer_cart_icon( 'arrow-r', 15 ); // phpcs:ignore ?>
							<span>ادامه خرید و افزودن محصول دیگر</span>
						</a>
						<button type="submit" name="update_cart" value="به‌روزرسانی سبد خرید" class="hkr-sync-btn">
							<?php echo higer_cart_icon( 'refresh', 14 ); // phpcs:ignore ?>
							<span>به‌روزرسانی سبد</span>
						</button>
						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</div>
				</form>

				<?php
				if ( $show_cross && ! empty( $beh['show_cross_sells'] ) ) :
					$cross = higer_cart_collect_suggestions( $cart, $cfg, false );
					if ( ! empty( $cross ) ) : ?>
						<section class="hkr-suggest hkr-suggest-inline">
							<div class="hkr-suggest-head">
								<div>
									<span class="hkr-kicker"><?php echo higer_cart_icon( 'spark', 12 ); // phpcs:ignore ?> تکمیل خرید</span>
									<h3>محصولات مکمل پیشنهادی (تاپر و محافظ تشک)</h3>
								</div>
								<a class="hkr-link-more" href="<?php echo esc_url( $urls['shop'] ); ?>">فروشگاه <?php echo higer_cart_icon( 'arrow-l', 14 ); // phpcs:ignore ?></a>
							</div>
							<div class="hkr-suggest-grid">
								<?php foreach ( $cross as $cp ) :
									$c_link = $cp->get_permalink();
									$c_img  = $cp->get_image( 'woocommerce_thumbnail' );
									$c_min  = (float) $cp->get_price();
									?>
									<a class="hkr-s-card" href="<?php echo esc_url( $c_link ); ?>">
										<div class="hkr-s-thumb"><?php echo wp_kses_post( $c_img ); ?></div>
										<div class="hkr-s-body">
											<b><?php echo esc_html( $cp->get_name() ); ?></b>
											<span><?php echo $c_min > 0 ? ( $cp->is_type( 'variable' ) ? 'انتخاب سایز — از ' : '' ) . higer_cart_money_fa( wc_price( $c_min ) ) : 'مشاهده محصول'; // phpcs:ignore ?></span>
										</div>
									</a>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endif;
				endif; ?>
			</div>

			<!-- ستون چپ: خلاصه سفارش، کد تخفیف و تسویه حساب -->
			<aside class="hkr-summary-col" aria-label="خلاصه سفارش">
				<div class="hkr-summary-card">
					<h2 class="hkr-summary-title">خلاصه سفارش</h2>

					<?php if ( $coupons_ok ) : ?>
					<div class="hkr-coupon-box">
						<div class="hkr-coupon-row">
							<span class="hkr-coupon-ico"><?php echo higer_cart_icon( 'tag', 15 ); // phpcs:ignore ?></span>
							<input type="text" class="hkr-coupon-input" placeholder="کد تخفیف دارید؟" dir="ltr" autocomplete="off" data-hkr-coupon-input>
							<button type="button" class="hkr-coupon-btn" data-hkr-coupon-apply>ثبت کد</button>
						</div>

						<?php $applied = $cart->get_applied_coupons(); if ( ! empty( $applied ) ) : ?>
							<div class="hkr-applied-list">
								<?php foreach ( $applied as $code ) :
									$disc = $cart->get_coupon_discount_amount( $code, $cart->display_prices_including_tax() );
									?>
									<div class="hkr-applied-pill">
										<span><?php echo higer_cart_icon( 'check', 13 ); // phpcs:ignore ?> کد <b><?php echo esc_html( $code ); ?></b><?php if ( $disc > 0 ) : ?> (<?php echo higer_cart_money_fa( wc_price( $disc ) ); // phpcs:ignore ?>−)<?php endif; ?></span>
										<button type="button" data-hkr-coupon-remove="<?php echo esc_attr( $code ); ?>" aria-label="حذف کد تخفیف"><?php echo higer_cart_icon( 'close', 13 ); // phpcs:ignore ?></button>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<dl class="hkr-totals">
						<div class="hkr-total-row">
							<dt>جمع جزء (<?php echo esc_html( higer_cart_fa( $count ) ); ?> کالا)</dt>
							<dd><?php echo higer_cart_money_fa( $cart->get_cart_subtotal() ); // phpcs:ignore ?></dd>
						</div>

						<?php if ( $cart->get_discount_total() > 0 ) : ?>
						<div class="hkr-total-row is-discount">
							<dt>سود شما از تخفیف</dt>
							<dd><?php echo higer_cart_money_fa( wc_price( $cart->get_discount_total() ) ); // phpcs:ignore ?>−</dd>
						</div>
						<?php endif; ?>

						<?php foreach ( $cart->get_fees() as $fee ) : ?>
						<div class="hkr-total-row">
							<dt><?php echo esc_html( $fee->name ); ?></dt>
							<dd><?php echo higer_cart_money_fa( wc_price( $fee->total ) ); // phpcs:ignore ?></dd>
						</div>
						<?php endforeach; ?>

						<?php if ( $cart->needs_shipping() ) : ?>
						<div class="hkr-total-row">
							<dt>ارسال</dt>
							<dd>
								<?php
								if ( $cart->show_shipping() && (float) $cart->get_shipping_total() > 0 ) {
									echo higer_cart_money_fa( wc_price( (float) $cart->get_shipping_total() ) ); // phpcs:ignore
								} else {
									echo '<span class="hkr-ship-tag">محاسبه در تسویه حساب</span>';
								}
								?>
							</dd>
						</div>
						<?php endif; ?>

						<?php if ( wc_tax_enabled() && ! $cart->display_prices_including_tax() && $cart->get_taxes_total() > 0 ) : ?>
						<div class="hkr-total-row">
							<dt><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></dt>
							<dd><?php echo higer_cart_money_fa( wc_price( $cart->get_taxes_total() ) ); // phpcs:ignore ?></dd>
						</div>
						<?php endif; ?>

						<div class="hkr-total-row is-grand">
							<dt>مبلغ قابل پرداخت</dt>
							<dd><?php echo higer_cart_money_fa( $cart->get_total() ); // phpcs:ignore ?></dd>
						</div>
					</dl>

					<?php if ( ! empty( $cfg['shipping_note'] ) ) : ?>
						<p class="hkr-ship-note"><?php echo higer_cart_icon( 'truck', 14 ); // phpcs:ignore ?> <span><?php echo esc_html( $cfg['shipping_note'] ); ?></span></p>
					<?php endif; ?>

					<a class="hkr-btn-gold hkr-checkout-btn" href="<?php echo esc_url( $chk_url ); ?>">
						<span>ادامه جهت تسویه حساب</span>
						<?php echo higer_cart_icon( 'arrow-l', 16 ); // phpcs:ignore ?>
					</a>

					<?php if ( ! empty( $beh['show_whatsapp_help'] ) && ! empty( $store['whatsapp_num'] ) ) :
						$wa_url = 'https://wa.me/' . preg_replace( '/\D+/', '', $store['whatsapp_num'] ) . '?text=' . rawurlencode( implode( "\n", $wa_lines ) );
						?>
						<div class="hkr-help-row">
							<a class="hkr-wa-btn" href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer">
								<?php echo higer_cart_icon( 'whatsapp', 15 ); // phpcs:ignore ?>
								<span>مشاوره این سبد در واتساپ</span>
							</a>
							<a class="hkr-tel-btn" href="<?php echo esc_url( $store['tel'] ); ?>">
								<?php echo higer_cart_icon( 'phone', 14 ); // phpcs:ignore ?>
								<span dir="ltr"><?php echo esc_html( $store['phone'] ); ?></span>
							</a>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $cfg['assurances'] ) ) : ?>
						<ul class="hkr-assure-list">
							<?php foreach ( (array) $cfg['assurances'] as $as ) : ?>
								<li>
									<span class="hkr-assure-ico"><?php echo higer_cart_icon( $as['icon'], 15 ); // phpcs:ignore ?></span>
									<div>
										<b><?php echo esc_html( $as['title'] ); ?></b>
										<small><?php echo esc_html( $as['sub'] ); ?></small>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</aside>
		</div>

		<!-- نوار چسبنده تسویه حساب در موبایل -->
		<div class="hkr-mobile-bar">
			<div class="hkr-mobile-meta">
				<small>مبلغ قابل پرداخت (<?php echo esc_html( higer_cart_fa( $count ) ); ?> کالا)</small>
				<strong><?php echo higer_cart_money_fa( $cart->get_total() ); // phpcs:ignore ?></strong>
			</div>
			<a class="hkr-btn-gold" href="<?php echo esc_url( $chk_url ); ?>">
				<span>تسویه حساب</span>
				<?php echo higer_cart_icon( 'arrow-l', 15 ); // phpcs:ignore ?>
			</a>
		</div>
		<?php
		return (string) ob_get_clean();
	}
}

/* پردازشگر AJAX سبد خرید (تعداد، حذف، خالی کردن، کد تخفیف + همگام‌سازی هدر) */
if ( ! function_exists( 'higer_cart_ajax_handler' ) ) {
	function higer_cart_ajax_handler() {
		if ( ! function_exists( 'WC' ) ) {
			wp_send_json( array( 'ok' => false, 'message' => 'ووکامرس فعال نیست.' ) );
		}
		if ( ! check_ajax_referer( 'higer_cart', 'nonce', false ) ) {
			wp_send_json( array( 'ok' => false, 'message' => 'نشست صفحه منقضی شده است. لطفاً صفحه را یک بار تازه (Refresh) کنید.' ) );
		}
		if ( null === WC()->cart && function_exists( 'wc_load_cart' ) ) {
			wc_load_cart();
		}
		$cart = WC()->cart;
		if ( ! $cart ) {
			wp_send_json( array( 'ok' => false, 'message' => 'سبد خرید در دسترس نیست.' ) );
		}

		if ( function_exists( 'wc_clear_notices' ) ) {
			wc_clear_notices();
		}

		$op      = isset( $_POST['op'] ) ? sanitize_key( wp_unslash( $_POST['op'] ) ) : '';
		$ok      = true;
		$message = '';

		if ( 'set_qty' === $op ) {
			$key = isset( $_POST['key'] ) ? sanitize_text_field( wp_unslash( $_POST['key'] ) ) : '';
			$qty = isset( $_POST['qty'] ) ? (int) higer_cart_en_digits( sanitize_text_field( wp_unslash( $_POST['qty'] ) ) ) : 1;
			$ci  = $cart->get_cart_item( $key );
			if ( ! $ci ) {
				$ok      = false;
				$message = 'این ردیف در سبد خرید یافت نشد.';
			} elseif ( $qty <= 0 ) {
				$cart->remove_cart_item( $key );
				$message = 'محصول از سبد خرید حذف شد.';
			} else {
				$_prod   = $ci['data'];
				$max_qty = $_prod ? $_prod->get_max_purchase_quantity() : -1;
				if ( $max_qty > 0 && $qty > $max_qty ) {
					$qty     = $max_qty;
					$ok      = false;
					$message = 'حداکثر موجودی قابل سفارش این کالا ' . higer_cart_fa( $max_qty ) . ' عدد است.';
				}
				$cart->set_quantity( $key, $qty, true );
				if ( '' === $message ) {
					$message = 'تعداد محصول به‌روزرسانی شد.';
				}
			}
		} elseif ( 'remove' === $op ) {
			$key = isset( $_POST['key'] ) ? sanitize_text_field( wp_unslash( $_POST['key'] ) ) : '';
			if ( $key && $cart->get_cart_item( $key ) ) {
				$cart->remove_cart_item( $key );
				$message = 'محصول از سبد خرید حذف شد.';
			}
		} elseif ( 'clear' === $op ) {
			$cart->empty_cart();
			$message = 'سبد خرید شما خالی شد.';
		} elseif ( 'apply_coupon' === $op ) {
			$raw  = isset( $_POST['code'] ) ? sanitize_text_field( wp_unslash( $_POST['code'] ) ) : '';
			$code = function_exists( 'wc_format_coupon_code' ) ? wc_format_coupon_code( $raw ) : trim( $raw );
			if ( '' === $code ) {
				$ok      = false;
				$message = 'لطفاً کد تخفیف را وارد کنید.';
			} elseif ( $cart->has_discount( $code ) ) {
				$ok      = false;
				$message = 'این کد تخفیف قبلاً روی سبد شما اعمال شده است.';
			} else {
				$applied = $cart->apply_coupon( $code );
				if ( $applied ) {
					$message = 'کد تخفیف با موفقیت اعمال شد.';
				} else {
					$ok   = false;
					$errs = function_exists( 'wc_get_notices' ) ? wc_get_notices( 'error' ) : array();
					if ( ! empty( $errs ) ) {
						$first   = reset( $errs );
						$message = wp_strip_all_tags( is_array( $first ) && isset( $first['notice'] ) ? $first['notice'] : (string) $first );
					} else {
						$message = 'کد تخفیف معتبر نیست یا شرایط استفاده از آن برقرار نیست.';
					}
				}
			}
		} elseif ( 'remove_coupon' === $op ) {
			$raw  = isset( $_POST['code'] ) ? sanitize_text_field( wp_unslash( $_POST['code'] ) ) : '';
			$code = function_exists( 'wc_format_coupon_code' ) ? wc_format_coupon_code( $raw ) : trim( $raw );
			if ( '' !== $code ) {
				$cart->remove_coupon( $code );
				$message = 'کد تخفیف حذف شد.';
			}
		}

		if ( function_exists( 'wc_clear_notices' ) ) {
			wc_clear_notices();
		}

		$cart->calculate_totals();
		$cfg       = higer_cart_config();
		$show_cs   = ! isset( $_POST['cross'] ) || 'no' !== sanitize_key( wp_unslash( $_POST['cross'] ) );
		$html      = higer_cart_render_inner( $cfg, $show_cs );
		$fragments = apply_filters( 'woocommerce_add_to_cart_fragments', array() );

		wp_send_json( array(
			'ok'        => $ok,
			'message'   => $message,
			'count'     => (int) $cart->get_cart_contents_count(),
			'html'      => $html,
			'fragments' => is_array( $fragments ) ? $fragments : array(),
		) );
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'wp_ajax_higer_cart', 'higer_cart_ajax_handler' );
		add_action( 'wp_ajax_nopriv_higer_cart', 'higer_cart_ajax_handler' );
	}
}

/* ============================================================
   بخش ۳ — استایل و اسکریپت (فقط یک‌بار در صفحه چاپ می‌شود)
   ============================================================ */

if ( ! function_exists( 'higer_cart_assets' ) ) {
	function higer_cart_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		$ajax    = function_exists( 'admin_url' ) ? admin_url( 'admin-ajax.php' ) : '/wp-admin/admin-ajax.php';
		$nonce   = function_exists( 'wp_create_nonce' ) ? wp_create_nonce( 'higer_cart' ) : '';
		ob_start();
		?>
<style id="higer-cart-styles">
/* ================== هیگر — استایل صفحه سبد خرید (نسخه بدون بیلد) ================== */
.higer-cart{
  --hkr-navy-950:#070f1d;--hkr-navy-900:#10243e;--hkr-navy-800:#183250;--hkr-navy-700:#1f3e63;--hkr-navy-600:#2b4e77;
  --hkr-gold-600:#c8892a;--hkr-gold-500:#d9a13b;--hkr-gold-400:#e7b95c;--hkr-gold-300:#f3d98b;--hkr-gold-200:#f8ead0;
  --hkr-cream:#faf7ef;--hkr-paper:#f3efe3;--hkr-line:#e3ddcd;--hkr-ok:#047857;--hkr-bad:#b91c1c;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--hkr-navy-900);background:var(--hkr-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-cart *,.higer-cart *::before,.higer-cart *::after{box-sizing:border-box}
.higer-cart :is(h1,h2,h3,h4,p,ul,ol,dl,dd,figure){margin:0;padding:0;border:0}
.higer-cart :is(h1,h2,h3,h4){font-family:inherit;color:inherit;font-weight:900;line-height:1.5;letter-spacing:normal;text-transform:none}
.higer-cart :is(ul,ol){list-style:none}
.higer-cart a{color:inherit;text-decoration:none!important;background:none}
.higer-cart button{font:inherit;color:inherit;background:none;border:0;border-radius:0;padding:0;margin:0;cursor:pointer;box-shadow:none;text-transform:none;letter-spacing:normal}
.higer-cart img{display:block;max-width:100%;height:auto;border:0}
.higer-cart svg{flex:none;display:block}
.higer-cart .hkr-i{display:inline-block;vertical-align:middle}
.higer-cart [hidden]{display:none!important}
.higer-cart :focus-visible{outline:3px solid var(--hkr-gold-600);outline-offset:3px}
.higer-cart .hkr-wrap{width:100%;max-width:1320px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-cart .hkr-wrap{padding-inline:24px}}

/* نشان‌ها و دکمه‌ها */
.higer-cart .hkr-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.78);color:var(--hkr-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800}
.higer-cart .hkr-kicker.is-dark{background:rgba(7,15,29,.55);color:var(--hkr-gold-300);border-color:rgba(217,161,59,.4)}
.higer-cart .hkr-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-cart :is(a,button).hkr-btn-gold{position:relative;overflow:hidden;display:inline-flex;align-items:center;justify-content:center;gap:8px;border:0;border-radius:9999px;padding:13px 24px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hkr-navy-900)!important;font-size:13.5px;font-weight:900;white-space:nowrap;box-shadow:0 12px 26px rgba(217,161,59,.34),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .22s,filter .22s}
.higer-cart :is(a,button).hkr-btn-gold:hover{transform:translateY(-2px);filter:brightness(1.04)}
.higer-cart :is(a,button).hkr-btn-dark{display:inline-flex;align-items:center;justify-content:center;gap:8px;border-radius:9999px;padding:13px 22px;background:var(--hkr-navy-900);color:var(--hkr-gold-300)!important;font-size:13px;font-weight:800;transition:background .2s,transform .2s}
.higer-cart :is(a,button).hkr-btn-dark:hover{background:var(--hkr-navy-800);transform:translateY(-1px)}

/* سربرگ سرمه‌ای سبد خرید + نوار مراحل */
.higer-cart .hkr-hero{position:relative;overflow:hidden;padding-block:0 36px;background:radial-gradient(960px 440px at 85% -10%,rgba(217,161,59,.18),transparent 60%),radial-gradient(800px 420px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 48%,#16304f 100%);color:var(--hkr-cream)}
.higer-cart .hkr-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-cart .hkr-hero>*{position:relative}
.higer-cart .hkr-crumbs{margin-bottom:26px;border-bottom:1px solid rgba(243,217,139,.16)}
.higer-cart .hkr-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:rgba(250,247,239,.72)}
.higer-cart .hkr-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-cart .hkr-crumbs li+li::before{content:"‹";color:var(--hkr-gold-400);font-weight:900}
.higer-cart .hkr-crumbs a:hover{color:var(--hkr-gold-300)}
.higer-cart .hkr-crumbs [aria-current]{color:#fff;font-weight:900}
.higer-cart .hkr-hero-row{display:flex;flex-direction:column;gap:22px}
@media(min-width:1024px){.higer-cart .hkr-hero-row{flex-direction:row;align-items:flex-end;justify-content:space-between}}
.higer-cart .hkr-hero-title{margin-top:12px;font-size:28px;color:#fff}
@media(min-width:640px){.higer-cart .hkr-hero-title{font-size:36px}}
.higer-cart .hkr-hero-sub{margin-top:8px;max-width:560px;font-size:13px;line-height:1.95;color:rgba(248,234,208,.84)}

/* نوار ۳ مرحله خرید */
.higer-cart .hkr-steps{display:flex;flex-wrap:wrap;align-items:center;gap:8px;padding:10px 12px;border-radius:18px;border:1px solid rgba(243,217,139,.22);background:rgba(7,15,29,.45)}
.higer-cart .hkr-step{display:inline-flex;align-items:center;gap:8px;padding:6px 10px;border-radius:12px;font-size:12px;font-weight:800;color:rgba(250,247,239,.58)}
.higer-cart .hkr-step-num{display:grid;place-items:center;width:24px;height:24px;border-radius:50%;border:1px solid rgba(243,217,139,.28);font-size:11px;font-weight:900}
.higer-cart .hkr-step.is-current{background:rgba(217,161,59,.16);color:var(--hkr-gold-200)}
.higer-cart .hkr-step.is-current .hkr-step-num{border-color:transparent;background:linear-gradient(180deg,#ecc470,#c8892a);color:var(--hkr-navy-900)}
.higer-cart .hkr-step.is-next:hover{color:var(--hkr-gold-300)}
.higer-cart .hkr-step-sep{color:rgba(243,217,139,.3);font-weight:900}

/* بخش اصلی و پیام‌ها */
.higer-cart .hkr-body-sec{padding-block:34px 64px}
@media(max-width:1023px){.higer-cart .hkr-body-sec{padding-bottom:112px}}
.higer-cart .hkr-wc-notices :is(.woocommerce-message,.woocommerce-info,.woocommerce-error){display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin:0 0 16px;padding:13px 18px;border:1px solid var(--hkr-line);border-radius:16px;background:#fff;font-size:13px;font-weight:700;list-style:none;box-shadow:0 10px 24px rgba(16,36,62,.05)}
.higer-cart .hkr-wc-notices .woocommerce-error{border-color:rgba(185,28,28,.35);background:#fef2f2;color:#991b1b}
.higer-cart .hkr-toast{margin-bottom:16px;padding:12px 16px;border-radius:14px;border:1px solid;font-size:12.5px;font-weight:800;display:flex;align-items:center;justify-content:space-between;gap:10px}
.higer-cart .hkr-toast[data-ok="1"]{background:#ecfdf5;border-color:#6ee7b7;color:#065f46}
.higer-cart .hkr-toast[data-ok="0"]{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
.higer-cart .hkr-stage{position:relative;transition:opacity .2s ease}
.higer-cart .hkr-stage.is-busy{opacity:.58;pointer-events:none}

/* چیدمان ۲ ستونه سبد پر */
.higer-cart .hkr-grid{display:grid;gap:24px;align-items:start}
@media(min-width:1024px){.higer-cart .hkr-grid{grid-template-columns:minmax(0,1.45fr) minmax(340px,.85fr);gap:28px}}
.higer-cart .hkr-cart-form{padding:22px;border:1px solid var(--hkr-line);border-radius:26px;background:#fff;box-shadow:0 20px 50px rgba(16,36,62,.06)}
@media(min-width:640px){.higer-cart .hkr-cart-form{padding:26px}}
.higer-cart .hkr-list-head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;padding-bottom:16px;margin-bottom:16px;border-bottom:1px solid var(--hkr-line)}
.higer-cart .hkr-list-title{display:flex;align-items:center;gap:9px;color:var(--hkr-navy-900)}
.higer-cart .hkr-list-title .hkr-i{color:var(--hkr-gold-600)}
.higer-cart .hkr-list-title h2{font-size:17px}
.higer-cart .hkr-list-title h2 span{font-size:13px;font-weight:700;color:var(--hkr-navy-600)}
.higer-cart button.hkr-clear-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 13px;border-radius:9999px;border:1px solid var(--hkr-line);background:var(--hkr-cream);font-size:11.5px;font-weight:800;color:var(--hkr-navy-700);transition:all .2s}
.higer-cart button.hkr-clear-btn:hover{border-color:rgba(185,28,28,.4);background:#fef2f2;color:var(--hkr-bad)}

/* کارت هر آیتم سبد */
.higer-cart .hkr-item-list{display:grid;gap:14px}
.higer-cart .hkr-item{display:grid;grid-template-columns:84px minmax(0,1fr);gap:14px;padding:16px;border:1px solid var(--hkr-line);border-radius:20px;background:#fffdf8;transition:border-color .2s,box-shadow .2s}
@media(min-width:640px){.higer-cart .hkr-item{grid-template-columns:108px minmax(0,1fr);gap:18px;padding:18px}}
.higer-cart .hkr-item:hover{border-color:rgba(217,161,59,.55);box-shadow:0 12px 28px rgba(16,36,62,.06)}
.higer-cart .hkr-item-thumb{aspect-ratio:1/1;border-radius:15px;overflow:hidden;background:var(--hkr-navy-900);border:1px solid var(--hkr-line)}
.higer-cart .hkr-item-thumb img{width:100%;height:100%;object-fit:cover}
.higer-cart .hkr-item-main{display:flex;flex-direction:column;justify-content:space-between;gap:14px;min-width:0}
.higer-cart .hkr-item-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px}
.higer-cart .hkr-item-title{display:inline-block;font-size:15px;font-weight:900;color:var(--hkr-navy-900);line-height:1.55;transition:color .2s}
.higer-cart a.hkr-item-title:hover{color:var(--hkr-gold-600)}
.higer-cart .hkr-item-badges{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}
.higer-cart .hkr-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:9999px;background:var(--hkr-paper);border:1px solid var(--hkr-line);font-size:11px;color:var(--hkr-navy-800)}
.higer-cart .hkr-badge small{color:var(--hkr-navy-600);font-weight:700}
.higer-cart .hkr-badge b{font-weight:900;color:var(--hkr-navy-900)}
.higer-cart .hkr-item-extra{margin-top:6px;font-size:11.5px;color:var(--hkr-navy-600)}
.higer-cart a.hkr-remove{display:grid;place-items:center;width:34px;height:34px;border-radius:50%;border:1px solid var(--hkr-line);background:#fff;color:var(--hkr-navy-600);flex:none;transition:all .2s}
.higer-cart a.hkr-remove:hover{border-color:rgba(185,28,28,.45);background:#fef2f2;color:var(--hkr-bad)}

.higer-cart .hkr-item-foot{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;padding-top:12px;border-top:1px dashed var(--hkr-line)}
.higer-cart .hkr-unit small,.higer-cart .hkr-line-total small{display:block;font-size:10.5px;font-weight:700;color:var(--hkr-navy-600)}
.higer-cart .hkr-unit span{font-size:12.5px;font-weight:800;color:var(--hkr-navy-800)}
.higer-cart .hkr-line-total strong{font-size:15px;font-weight:900;color:var(--hkr-navy-900)}
.higer-cart .hkr-qty{display:inline-flex;align-items:center;overflow:hidden;border:1.5px solid var(--hkr-line);border-radius:9999px;background:#fff}
.higer-cart button.hkr-qty-btn{display:grid;place-items:center;width:36px;height:38px;color:var(--hkr-navy-900);transition:background .18s,color .18s}
.higer-cart button.hkr-qty-btn:hover:not(:disabled){background:var(--hkr-paper);color:var(--hkr-gold-600)}
.higer-cart button.hkr-qty-btn:disabled{opacity:.35;cursor:not-allowed}
.higer-cart input.hkr-qty-input{width:42px;height:38px;border:0;background:transparent;text-align:center;font:inherit;font-size:13.5px;font-weight:900;color:var(--hkr-navy-900);outline:none;-moz-appearance:textfield;appearance:textfield}
.higer-cart input.hkr-qty-input::-webkit-inner-spin-button,.higer-cart input.hkr-qty-input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}
.higer-cart .hkr-qty-single{font-size:12px;font-weight:800;color:var(--hkr-navy-700);padding:6px 12px;border-radius:999px;background:var(--hkr-paper)}

.higer-cart .hkr-form-bar{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-top:18px;padding-top:16px;border-top:1px solid var(--hkr-line)}
.higer-cart a.hkr-back-shop{display:inline-flex;align-items:center;gap:7px;font-size:12.5px;font-weight:800;color:var(--hkr-navy-700);transition:color .2s}
.higer-cart a.hkr-back-shop:hover{color:var(--hkr-gold-600)}
.higer-cart button.hkr-sync-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 15px;border-radius:9999px;border:1px solid var(--hkr-line);background:var(--hkr-paper);font-size:12px;font-weight:800;color:var(--hkr-navy-800);transition:border-color .2s}
.higer-cart button.hkr-sync-btn:hover{border-color:var(--hkr-gold-500)}

/* ستون خلاصه سفارش */
@media(min-width:1024px){.higer-cart .hkr-summary-col{position:sticky;top:98px}}
.higer-cart .hkr-summary-card{padding:24px;border-radius:26px;border:1px solid rgba(243,217,139,.28);background:radial-gradient(420px 220px at 90% 0%,rgba(217,161,59,.16),transparent 70%),linear-gradient(165deg,#0b1a30 0%,#10243e 58%,#142c4c 100%);color:var(--hkr-cream);box-shadow:0 26px 64px rgba(7,15,29,.28)}
.higer-cart .hkr-summary-title{font-size:18px;color:#fff;padding-bottom:14px;border-bottom:1px solid rgba(243,217,139,.16)}

/* کادر کد تخفیف */
.higer-cart .hkr-coupon-box{margin-top:16px;padding-bottom:16px;border-bottom:1px solid rgba(243,217,139,.14)}
.higer-cart .hkr-coupon-row{display:flex;align-items:center;gap:8px;padding:6px;border-radius:16px;border:1px solid rgba(243,217,139,.22);background:rgba(7,15,29,.48)}
.higer-cart .hkr-coupon-ico{padding-right:8px;color:var(--hkr-gold-300)}
.higer-cart input.hkr-coupon-input{flex:1;min-width:0;border:0;background:transparent;color:#fff;font:inherit;font-size:13px;font-weight:700;outline:none;text-align:left}
.higer-cart input.hkr-coupon-input::placeholder{color:rgba(250,247,239,.48);text-align:right;font-weight:500}
.higer-cart button.hkr-coupon-btn{padding:8px 14px;border-radius:11px;background:rgba(243,217,139,.16);border:1px solid rgba(243,217,139,.34);color:var(--hkr-gold-200);font-size:12px;font-weight:800;white-space:nowrap;transition:all .2s}
.higer-cart button.hkr-coupon-btn:hover{background:var(--hkr-gold-500);border-color:var(--hkr-gold-500);color:var(--hkr-navy-900)}
.higer-cart .hkr-applied-list{display:grid;gap:6px;margin-top:10px}
.higer-cart .hkr-applied-pill{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:7px 11px;border-radius:12px;background:rgba(16,185,129,.14);border:1px solid rgba(110,231,183,.35);font-size:11.5px;color:#d1fae5}
.higer-cart .hkr-applied-pill span{display:inline-flex;align-items:center;gap:5px}
.higer-cart .hkr-applied-pill button{color:#a7f3d0;display:grid;place-items:center}

/* ارقام جمع کل */
.higer-cart .hkr-totals{margin-top:16px;display:grid;gap:11px}
.higer-cart .hkr-total-row{display:flex;align-items:center;justify-content:space-between;gap:10px;font-size:13px;color:rgba(250,247,239,.8)}
.higer-cart .hkr-total-row dd{font-weight:800;color:#fff}
.higer-cart .hkr-total-row.is-discount dd{color:#6ee7b7}
.higer-cart .hkr-ship-tag{font-size:11.5px;font-weight:700;color:var(--hkr-gold-300)}
.higer-cart .hkr-total-row.is-grand{margin-top:6px;padding-top:14px;border-top:1px solid rgba(243,217,139,.2);font-size:14.5px;font-weight:900;color:#fff}
.higer-cart .hkr-total-row.is-grand dd{font-size:19px;font-weight:900;color:var(--hkr-gold-300)}
.higer-cart .hkr-ship-note{display:flex;align-items:flex-start;gap:8px;margin-top:14px;padding:10px 12px;border-radius:14px;background:rgba(255,255,255,.05);font-size:11.5px;line-height:1.85;color:rgba(248,234,208,.76)}
.higer-cart .hkr-ship-note .hkr-i{color:var(--hkr-gold-400);margin-top:3px}
.higer-cart a.hkr-checkout-btn{width:100%;margin-top:16px;padding-block:15px;font-size:14px}

.higer-cart .hkr-help-row{display:grid;grid-template-columns:1fr auto;gap:8px;margin-top:10px}
.higer-cart a.hkr-wa-btn,.higer-cart a.hkr-tel-btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:10px 12px;border-radius:9999px;border:1px solid rgba(243,217,139,.26);background:rgba(7,15,29,.36);font-size:11.5px;font-weight:800;color:var(--hkr-gold-200)!important;transition:all .2s}
.higer-cart a.hkr-wa-btn:hover,.higer-cart a.hkr-tel-btn:hover{border-color:var(--hkr-gold-400);background:rgba(217,161,59,.14)}

.higer-cart .hkr-assure-list{margin-top:18px;padding-top:16px;border-top:1px solid rgba(243,217,139,.14);display:grid;gap:10px}
.higer-cart .hkr-assure-list li{display:flex;align-items:flex-start;gap:10px}
.higer-cart .hkr-assure-ico{display:grid;place-items:center;width:30px;height:30px;border-radius:9px;background:rgba(217,161,59,.14);color:var(--hkr-gold-300);flex:none;margin-top:1px}
.higer-cart .hkr-assure-list b{display:block;font-size:12px;font-weight:800;color:#fff}
.higer-cart .hkr-assure-list small{display:block;font-size:10.5px;color:rgba(250,247,239,.62)}

/* کارت سبد خالی */
.higer-cart .hkr-empty-card{max-width:52rem;margin-inline:auto;padding:42px 24px;border:1px solid var(--hkr-line);border-radius:28px;background:#fff;text-align:center;box-shadow:0 24px 60px rgba(16,36,62,.07)}
@media(min-width:640px){.higer-cart .hkr-empty-card{padding:52px 40px}}
.higer-cart .hkr-empty-ring{display:grid;place-items:center;width:74px;height:74px;margin:0 auto 18px;border-radius:50%;background:var(--hkr-navy-900);color:var(--hkr-gold-400);box-shadow:0 14px 32px rgba(16,36,62,.2)}
.higer-cart .hkr-empty-card h2{font-size:22px}
@media(min-width:640px){.higer-cart .hkr-empty-card h2{font-size:26px}}
.higer-cart .hkr-empty-card>p{max-width:34rem;margin:10px auto 0;font-size:13.5px;line-height:2;color:var(--hkr-navy-700)}
.higer-cart .hkr-empty-btns{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:12px;margin-top:24px}
.higer-cart .hkr-empty-cores{display:grid;gap:10px;margin-top:30px;padding-top:26px;border-top:1px solid var(--hkr-line);text-align:right}
@media(min-width:640px){.higer-cart .hkr-empty-cores{grid-template-columns:repeat(2,minmax(0,1fr))}}
.higer-cart a.hkr-empty-core{display:flex;align-items:center;gap:12px;padding:13px 15px;border:1px solid var(--hkr-line);border-radius:16px;background:var(--hkr-cream);transition:all .2s}
.higer-cart a.hkr-empty-core:hover{border-color:var(--hkr-gold-500);background:#fff;transform:translateY(-2px)}
.higer-cart .hkr-core-num{display:grid;place-items:center;width:34px;height:34px;border-radius:10px;background:var(--hkr-navy-900);color:var(--hkr-gold-300);font-size:11px;font-weight:900;flex:none}
.higer-cart a.hkr-empty-core b{display:block;font-size:13px;font-weight:900}
.higer-cart a.hkr-empty-core small{display:block;font-size:11px;color:var(--hkr-navy-600)}
.higer-cart .hkr-core-arr{margin-inline-start:auto;color:var(--hkr-gold-600)}

/* پیشنهاد محصولات مکمل */
.higer-cart .hkr-suggest{margin-top:34px}
.higer-cart .hkr-suggest-inline{margin-top:24px}
.higer-cart .hkr-suggest-head{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:12px;margin-bottom:16px}
.higer-cart .hkr-suggest-head h3{margin-top:8px;font-size:18px}
.higer-cart a.hkr-link-more{display:inline-flex;align-items:center;gap:5px;font-size:12.5px;font-weight:800;color:var(--hkr-gold-600)}
.higer-cart .hkr-suggest-grid{display:grid;gap:12px;grid-template-columns:repeat(2,minmax(0,1fr))}
@media(min-width:768px){.higer-cart .hkr-suggest-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
.higer-cart a.hkr-s-card{display:flex;flex-direction:column;overflow:hidden;border:1px solid var(--hkr-line);border-radius:18px;background:#fff;transition:transform .2s,border-color .2s}
.higer-cart a.hkr-s-card:hover{transform:translateY(-3px);border-color:var(--hkr-gold-500)}
.higer-cart .hkr-s-thumb{aspect-ratio:4/3;background:var(--hkr-navy-900);overflow:hidden}
.higer-cart .hkr-s-thumb img{width:100%;height:100%;object-fit:cover}
.higer-cart .hkr-s-body{padding:12px;display:flex;flex-direction:column;gap:4px}
.higer-cart .hkr-s-body b{font-size:12.5px;font-weight:900;color:var(--hkr-navy-900);line-height:1.5}
.higer-cart .hkr-s-body span{font-size:11.5px;font-weight:800;color:var(--hkr-gold-600)}

/* نوار چسبنده موبایل */
.higer-cart .hkr-mobile-bar{position:fixed;right:12px;left:12px;bottom:12px;z-index:9980;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 14px;border:1px solid rgba(217,161,59,.38);border-radius:20px;background:rgba(16,36,62,.96);color:var(--hkr-cream);box-shadow:0 18px 42px rgba(7,15,29,.5);backdrop-filter:blur(10px)}
@media(min-width:1024px){.higer-cart .hkr-mobile-bar{display:none}}
.higer-cart .hkr-mobile-meta small{display:block;font-size:10px;color:rgba(250,247,239,.68)}
.higer-cart .hkr-mobile-meta strong{display:block;font-size:14.5px;font-weight:900;color:var(--hkr-gold-300)}
.higer-cart .hkr-mobile-bar .hkr-btn-gold{padding:11px 18px;font-size:12.5px}
</style>

<script id="higer-cart-script">
(function () {
  if (window.__higerCartInit) return;
  window.__higerCartInit = true;

  var AJAX_URL = <?php echo wp_json_encode( $ajax ); ?>;
  var NONCE = <?php echo wp_json_encode( $nonce ); ?>;
  var FONTS = [
    'https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css',
    'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css'
  ];

  function addFonts() {
    var head = document.head || document.documentElement;
    FONTS.forEach(function (href) {
      if (document.querySelector('link[href="' + href + '"]')) return;
      var l = document.createElement('link');
      l.rel = 'stylesheet';
      l.href = href;
      head.appendChild(l);
    });
  }

  function applyFragments(fragments) {
    if (!fragments || typeof fragments !== 'object') return;
    Object.keys(fragments).forEach(function (selector) {
      var html = fragments[selector];
      if (typeof html !== 'string') return;
      document.querySelectorAll(selector).forEach(function (el) {
        el.outerHTML = html;
      });
    });
  }

  function mount(root) {
    if (root.getAttribute('data-hkr-mounted')) return;
    root.setAttribute('data-hkr-mounted', '1');

    if (root.getAttribute('data-hkr-fw') === 'yes') {
      var fit = function () {
        root.style.position = 'relative';
        root.style.maxWidth = 'none';
        root.style.left = '0px';
        root.style.width = document.documentElement.clientWidth + 'px';
        root.style.left = -root.getBoundingClientRect().left + 'px';
      };
      fit();
      window.addEventListener('resize', fit);
      window.addEventListener('load', fit);
      window.setTimeout(fit, 500);
    }

    var stage = root.querySelector('[data-hkr-stage]');
    var toast = root.querySelector('[data-hkr-toast]');
    var crossAttr = root.getAttribute('data-hkr-cross') || 'yes';
    var qtyTimers = {};

    function showToast(ok, msg) {
      if (!toast || !msg) return;
      toast.hidden = false;
      toast.setAttribute('data-ok', ok ? '1' : '0');
      toast.textContent = msg;
    }

    function sendOp(payload) {
      if (!stage || !window.fetch || !window.FormData) return;
      stage.classList.add('is-busy');
      var fd = new FormData();
      fd.set('action', 'higer_cart');
      fd.set('nonce', NONCE);
      fd.set('cross', crossAttr);
      Object.keys(payload).forEach(function (k) { fd.set(k, payload[k]); });

      fetch(AJAX_URL, { method: 'POST', body: fd, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          stage.classList.remove('is-busy');
          if (!res) return;
          if (typeof res.html === 'string' && res.html.length) {
            stage.innerHTML = res.html;
          }
          if (res.fragments) applyFragments(res.fragments);
          if (res.message) showToast(!!res.ok, res.message);
          if (window.jQuery) {
            window.jQuery(document.body).trigger('wc_fragment_refresh');
          }
        })
        .catch(function () {
          stage.classList.remove('is-busy');
          showToast(false, 'ارتباط با سرور برقرار نشد. لطفاً اتصال اینترنت را بررسی کنید.');
        });
    }

    root.addEventListener('click', function (e) {
      var stepBtn = e.target.closest('[data-hkr-step]');
      if (stepBtn) {
        e.preventDefault();
        var wrap = stepBtn.closest('[data-hkr-qty-wrap]');
        var input = wrap ? wrap.querySelector('[data-hkr-qty]') : null;
        if (!input) return;
        var key = input.getAttribute('data-hkr-qty');
        var cur = parseInt(input.value, 10) || 0;
        var delta = parseInt(stepBtn.getAttribute('data-hkr-step'), 10) || 0;
        var maxAttr = parseInt(input.getAttribute('max'), 10);
        var next = Math.max(0, cur + delta);
        if (!isNaN(maxAttr) && maxAttr > 0 && next > maxAttr) next = maxAttr;
        input.value = String(next);
        clearTimeout(qtyTimers[key]);
        qtyTimers[key] = window.setTimeout(function () {
          sendOp({ op: 'set_qty', key: key, qty: String(next) });
        }, 320);
        return;
      }

      var remBtn = e.target.closest('[data-hkr-remove]');
      if (remBtn) {
        if (!window.fetch) return;
        e.preventDefault();
        sendOp({ op: 'remove', key: remBtn.getAttribute('data-hkr-remove') });
        return;
      }

      var clearBtn = e.target.closest('[data-hkr-clear]');
      if (clearBtn) {
        e.preventDefault();
        if (window.confirm('آیا از خالی کردن کامل سبد خرید مطمئن هستید؟')) {
          sendOp({ op: 'clear' });
        }
        return;
      }

      var applyBtn = e.target.closest('[data-hkr-coupon-apply]');
      if (applyBtn) {
        e.preventDefault();
        var cInput = root.querySelector('[data-hkr-coupon-input]');
        sendOp({ op: 'apply_coupon', code: cInput ? cInput.value : '' });
        return;
      }

      var remCoupon = e.target.closest('[data-hkr-coupon-remove]');
      if (remCoupon) {
        e.preventDefault();
        sendOp({ op: 'remove_coupon', code: remCoupon.getAttribute('data-hkr-coupon-remove') });
      }
    });

    root.addEventListener('change', function (e) {
      var input = e.target.closest('[data-hkr-qty]');
      if (!input) return;
      var key = input.getAttribute('data-hkr-qty');
      clearTimeout(qtyTimers[key]);
      sendOp({ op: 'set_qty', key: key, qty: input.value });
    });

    root.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && e.target.matches('[data-hkr-coupon-input]')) {
        e.preventDefault();
        sendOp({ op: 'apply_coupon', code: e.target.value });
      }
    });
  }

  function init() {
    addFonts();
    Array.prototype.forEach.call(document.querySelectorAll('.higer-cart'), mount);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
</script>
		<?php
		return (string) ob_get_clean();
	}
}

/* ============================================================
   بخش ۴ — خروجی HTML و ثبت شورت‌کد [higer_cart]
   ============================================================ */

if ( ! function_exists( 'higer_cart_render' ) ) {
	function higer_cart_render( $atts = array() ) {
		$atts = function_exists( 'shortcode_atts' )
			? shortcode_atts( array( 'fullwidth' => 'yes', 'cross_sells' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_cart' )
			: array( 'fullwidth' => 'yes', 'cross_sells' => 'yes' );

		$cfg        = higer_cart_config();
		$hero       = $cfg['hero'];
		$beh        = $cfg['behavior'];
		$fullwidth  = 'no' !== strtolower( (string) $atts['fullwidth'] );
		$show_cross = 'no' !== strtolower( (string) $atts['cross_sells'] );
		$uid        = 'hkr-' . substr( md5( uniqid( 'higer-cart', true ) ), 0, 6 );

		if ( ! empty( $beh['suppress_footer_cta'] ) ) {
			$GLOBALS['higer_suppress_footer_cta'] = true;
		}
		if ( ! defined( 'WOOCOMMERCE_CART' ) ) {
			define( 'WOOCOMMERCE_CART', true );
		}
		if ( function_exists( 'nocache_headers' ) && ! headers_sent() ) {
			nocache_headers();
		}

		$notices = ( function_exists( 'WC' ) && WC() && ! empty( WC()->session ) && function_exists( 'wc_print_notices' ) )
			? (string) wc_print_notices( true )
			: '';

		ob_start();
		echo higer_cart_assets(); // phpcs:ignore
		?>
<div class="higer-cart" id="<?php echo esc_attr( $uid ); ?>" dir="rtl" lang="fa" data-hkr-fw="<?php echo $fullwidth ? 'yes' : 'no'; ?>" data-hkr-cross="<?php echo $show_cross ? 'yes' : 'no'; ?>">

	<!-- ===== سربرگ سرمه‌ای سبد خرید ===== -->
	<section class="hkr-hero">
		<div class="hkr-wrap">
			<nav class="hkr-crumbs" aria-label="مسیر صفحه">
				<ol>
					<li><a href="<?php echo esc_url( $cfg['urls']['home'] ); ?>">خانه</a></li>
					<li aria-current="page">سبد خرید</li>
				</ol>
			</nav>

			<div class="hkr-hero-row">
				<div>
					<span class="hkr-kicker is-dark"><?php echo higer_cart_icon( 'bag', 13 ); // phpcs:ignore ?> <?php echo esc_html( $hero['kicker'] ); ?></span>
					<h1 class="hkr-hero-title"><?php echo esc_html( $hero['title_a'] ); ?><span class="hkr-gold-text"><?php echo esc_html( $hero['title_b'] ); ?></span></h1>
					<p class="hkr-hero-sub"><?php echo esc_html( $hero['subtitle'] ); ?></p>
				</div>

				<?php if ( ! empty( $hero['steps'] ) ) : ?>
				<ol class="hkr-steps" aria-label="مراحل ثبت سفارش">
					<?php $si = 0; foreach ( (array) $hero['steps'] as $st ) : $si++; ?>
						<?php if ( $si > 1 ) : ?><li class="hkr-step-sep" aria-hidden="true">‹</li><?php endif; ?>
						<li>
							<?php if ( ! empty( $st['url'] ) && 'current' !== $st['state'] ) : ?>
								<a class="hkr-step is-<?php echo esc_attr( $st['state'] ); ?>" href="<?php echo esc_url( $st['url'] ); ?>">
									<span class="hkr-step-num"><?php echo esc_html( $st['num'] ); ?></span>
									<span><?php echo esc_html( $st['label'] ); ?></span>
								</a>
							<?php else : ?>
								<span class="hkr-step is-<?php echo esc_attr( $st['state'] ); ?>">
									<span class="hkr-step-num"><?php echo esc_html( $st['num'] ); ?></span>
									<span><?php echo esc_html( $st['label'] ); ?></span>
								</span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ol>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- ===== بدنه پویا (اقلام، خلاصه سفارش و پیشنهاد مکمل) ===== -->
	<section class="hkr-body-sec">
		<div class="hkr-wrap">
			<?php if ( '' !== trim( $notices ) ) : ?>
				<div class="hkr-wc-notices"><?php echo $notices; // phpcs:ignore ?></div>
			<?php endif; ?>
			<div class="hkr-toast" data-hkr-toast role="status" aria-live="polite" hidden></div>
			<div class="hkr-stage" data-hkr-stage>
				<?php echo higer_cart_render_inner( $cfg, $show_cross ); // phpcs:ignore ?>
			</div>
		</div>
	</section>
</div>
		<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_cart' ) ) {
	add_shortcode( 'higer_cart', 'higer_cart_render' );
}

/* حالت بدون المنتور: جایگزینی خودکار محتوای برگه سبد خرید */
if ( ! function_exists( 'higer_cart_auto_content' ) ) {
	function higer_cart_auto_content( $content ) {
		$cfg = higer_cart_config();
		if ( empty( $cfg['behavior']['auto_content'] ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}
		$is_target = ( function_exists( 'is_cart' ) && is_cart() )
			|| ( function_exists( 'is_page' ) && ! empty( $cfg['behavior']['page_slug'] ) && is_page( $cfg['behavior']['page_slug'] ) );
		return $is_target ? higer_cart_render() : $content;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'the_content', 'higer_cart_auto_content', 20 );
	}
}
