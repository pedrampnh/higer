<?php
/**
 * Higer Product — صفحه محصول هیگر | نسخه بدون بیلد (v1.0)
 * ============================================================
 * اسنیپت PHP برای WPCode که صفحه محصول ووکامرس را با همان طراحی صفحه
 * اصلی هیگر نمایش می‌دهد. قیمت هر سایز، موجودی، سفتی، گارانتی، چیدمان
 * لایه‌ها، دسته‌بندی، توضیحات و تصاویر مستقیم از خود ووکامرس خوانده
 * می‌شوند؛ با ویرایش محصول در پیشخوان، صفحه هم به‌روز می‌شود.
 *
 * ─── نصب در WPCode ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل این فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *  ۴. Save و Activate
 *
 * ─── نمایش در صفحه محصول ───
 *  با المنتور (روش فعلی سایت): Templates > Theme Builder > Single Product
 *  قالب محصول را باز کنید، ویجت‌های قبلی محتوا را حذف کنید و یک ویجت
 *  Shortcode با این متن بگذارید:   [higer_product]
 *  بدون المنتور: در تنظیمات پایین 'auto_replace' را true کنید.
 *
 * ─── شورت‌کد ───
 *  [higer_product]                 محصول همین صفحه
 *  [higer_product id="1215"]       یک محصول مشخص
 *  [higer_product fullwidth="no"]  بدون حالت تمام‌عرض
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_product_config' ) ) :
function higer_product_config() {
	return array(

		/* --- فروشگاه و تماس --- */
		'store' => array(
			'phone'   => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'     => 'tel:+989111186485',
			'address' => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی 27، فروشگاه و دفتر مرکزی هیگر',
			'hours'   => 'همه روزه بجز روزهای تعطیل،ساعت ۹ تا ۲۱',
		),

		/* --- رفتار اسنیپت --- */
		'auto_replace'    => false, // true = جایگزینی خودکار چیدمان پیش‌فرض ووکامرس (بدون المنتور)
		'structured_data' => false, // Rank Math روی سایت فعال است و اسکیمای محصول را خودش می‌سازد
		'show_reviews'    => true,  // نمایش فرم و فهرست نظرات ووکامرس
		'show_related'    => true,  // نمایش محصولات مرتبط
		'compare_limit'   => 40,    // حداکثر تعداد مدل‌هایی که برای مقایسه بارگذاری می‌شوند
		'compare_cache'   => 6,     // نگهداری داده مقایسه (ساعت)؛ با ویرایش محصولات خودکار تازه می‌شود. ۰ = بدون کش
		'sticky_offset'   => 0,     // فاصله از بالا برای هدر چسبنده سایت (پیکسل)؛ ۰ = تشخیص خودکار ارتفاع هدر
		'finder_path'     => '/#hg-finder', // لینک تشک‌سنج صفحه اصلی (خالی = پنهان)

		/* --- نامک ویژگی‌های ووکامرس (محصولات > ویژگی‌ها) --- */
		'attributes' => array(
			'size'     => 'pa_size',
			'firmness' => 'pa_firmness',
			'warranty' => 'pa_warranty',
			'layer'    => 'pa_layer-layout',
			'spring'   => 'pa_spring-type',
			'special'  => 'pa_special-layer',
			'fabric'   => 'pa_fabric-type',
		),

		/* --- عنوان کاربردی هر سایز (نامک سایز => عنوان؛ خالی = بدون عنوان) --- */
		'size_labels' => array(
			'70x130'  => 'نوزاد',
			'80x180'  => 'نوجوان',
			'90x200'  => 'یک‌نفره',
			'100x200' => '',
			'120x200' => 'یک‌نفره عریض',
			'140x200' => 'دونفره',
			'160x200' => 'کویین',
			'180x200' => 'کینگ',
			'200x200' => 'سوپرکینگ',
		),

		/* --- دسته‌بندی‌ها: نامک دسته => نوع هسته و توضیح --- */
		'cores' => array(
			'bonnell-spring'    => array( 'key' => 'bonnell', 'title' => 'فنر متصل', 'text' => 'در این نوع تشک، فنرهای هسته به یکدیگر متصل‌اند و یک شبکه یکپارچه می‌سازند.' ),
			'pocket-spring'     => array( 'key' => 'pocket', 'title' => 'فنر منفصل', 'text' => 'فنرهای این نوع تشک هر کدام در یک پاکت جداگانه قرار دارند.' ),
			'rebound'           => array( 'key' => 'rebond', 'title' => 'ریباند', 'text' => 'هسته ریباند از قطعات فوم فشرده‌شده ساخته می‌شود و فنر ندارد.' ),
			'high-density-foam' => array( 'key' => 'foam', 'title' => 'فوم سنگین', 'text' => 'در این نوع تشک، هسته از فوم ساخته شده و فنر ندارد.' ),
			'accessories'       => array( 'key' => 'accessory', 'title' => 'محصولات جانبی', 'text' => 'محصولاتی برای استفاده همراه با تشک.' ),
		),

		/* --- چیدمان لایه‌ها: نامک => توضیح --- */
		'layers' => array(
			'single-sided'      => 'فقط یک سطح تشک برای خواب در نظر گرفته شده است.',
			'double-sided-same' => 'هر دو سطح تشک قابل استفاده است و دو سطح کیفیت یکسانی دارند.',
			'double-sided-dual' => 'هر دو سطح تشک قابل استفاده است و کیفیت دو سطح با هم فرق دارد.',
		),

		/* --- نوع فنر، لایه ویژه و جنس پارچه: نامک => عنوان و توضیح کوتاه ---
		   برای مقداری که اینجا نیامده، توضیح همان مقدار در پیشخوان (محصولات > ویژگی‌ها) نمایش داده می‌شود. */
		'springs' => array(
			'micro' => array( 'title' => 'فنر میکرو', 'text' => 'فنرهای میکرو قطر و ارتفاع کمتری از فنرهای معمولی دارند و تعداد بیشتری از آن‌ها در هر بخش از تشک قرار می‌گیرد.' ),
			'2-2'   => array( 'title' => 'فنر ۲٫۲', 'text' => 'عدد ۲٫۲ در نام این فنر به قطر مفتول آن (۲٫۲ میلی‌متر) اشاره دارد.' ),
		),
		'special_layers' => array(
			'memory-foam'  => array( 'title' => 'مموری فوم', 'text' => 'مموری فوم با فشار و گرمای بدن به‌آرامی فرم می‌گیرد و پس از برداشتن فشار، کم‌کم به حالت اول برمی‌گردد.' ),
			'eurolux-foam' => array( 'title' => 'ابر یورولوکس', 'text' => 'در ساختار این تشک یک لایه ابر یورولوکس به کار رفته است. برای مشخصات این لایه با فروشگاه تماس بگیرید.' ),
		),
		'fabrics' => array(
			'circular-knit' => array( 'title' => 'گردبافت', 'text' => 'پارچه گردبافت با دستگاه بافندگی حلقوی تولید می‌شود؛ بافت آن از حلقه‌های درهم‌رفته تشکیل شده و کشسان است.' ),
		),

		/* --- اطلاعات خرید زیر دکمه سبد (آیکون: shield، card، truck، phone) --- */
		'purchase_info' => array(
			array( 'icon' => 'card', 'title' => 'پرداخت', 'text' => 'آنلاین با درگاه امن یا کارت‌به‌کارت.' ),
			array( 'icon' => 'truck', 'title' => 'ارسال', 'text' => 'برای زمان و هزینه ارسال با فروشگاه تماس بگیرید.' ),
		),

		/* --- سؤالات متداول صفحه محصول --- */
		'faqs' => array(
			array( 'q' => 'گارانتی از چه زمانی شروع می‌شود؟', 'a' => 'در فاکتور قید می‌شود.' ),
			array( 'q' => 'پرداخت چطور انجام می‌شود؟', 'a' => 'آنلاین با درگاه امن یا کارت‌به‌کارت.' ),
			array( 'q' => 'چطور از زمان و هزینه ارسال مطلع شوم؟', 'a' => 'برای اطلاع از شرایط ارسال به شهر خود با فروشگاه تماس بگیرید.' ),
			array( 'q' => 'برای ابعاد خاص هم تشک ساخته می‌شود؟', 'a' => 'امکان دوخت سفارشی برای ابعاد خاص وجود دارد. برای سفارش با فروشگاه تماس بگیرید.' ),
		),
	);
}
endif;


/* ============================================================
   بخش ۲ — موتور نمایش (معمولاً نیازی به تغییر نیست)
   ============================================================ */

if ( ! function_exists( 'higer_product_fa' ) ) {
	/** ارقام لاتین را به فارسی تبدیل می‌کند. */
	function higer_product_fa( $value ) {
		return str_replace(
			array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
			array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ),
			(string) $value
		);
	}
}

if ( ! function_exists( 'higer_product_number' ) ) {
	function higer_product_number( $amount ) {
		$decimals = function_exists( 'wc_get_price_decimals' ) ? (int) wc_get_price_decimals() : 0;
		return higer_product_fa( number_format( (float) $amount, $decimals, '.', ',' ) );
	}
}

if ( ! function_exists( 'higer_product_money' ) ) {
	function higer_product_money( $amount ) {
		$symbol = function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '';
		$symbol = trim( html_entity_decode( (string) $symbol, ENT_QUOTES, 'UTF-8' ) );
		return higer_product_number( $amount ) . ' ' . ( '' !== $symbol ? $symbol : 'تومان' );
	}
}

if ( ! function_exists( 'higer_product_size_parts' ) ) {
	/** «160x200» یا «160 در 200» را به array( 160, 200 ) تبدیل می‌کند. */
	function higer_product_size_parts( $value ) {
		return preg_match( '/^(\d+)\s*(?:x|×|\*|در)\s*(\d+)$/u', trim( (string) $value ), $m ) ? array( (int) $m[1], (int) $m[2] ) : null;
	}
}

if ( ! function_exists( 'higer_product_size_text' ) ) {
	function higer_product_size_text( $slug, $name ) {
		$parts = higer_product_size_parts( $slug );
		if ( ! $parts ) {
			$parts = higer_product_size_parts( $name );
		}
		return $parts ? higer_product_fa( $parts[0] . '×' . $parts[1] ) : higer_product_fa( $name );
	}
}

if ( ! function_exists( 'higer_product_size_compare' ) ) {
	/** سایزها را عددی مرتب می‌کند (۹۰×۲۰۰ قبل از ۱۰۰×۲۰۰). */
	function higer_product_size_compare( $a, $b ) {
		$pa = higer_product_size_parts( $a );
		$pb = higer_product_size_parts( $b );
		if ( ! $pa || ! $pb ) {
			return 0;
		}
		return ( $pa[0] === $pb[0] ) ? $pa[1] - $pb[1] : $pa[0] - $pb[0];
	}
}

if ( ! function_exists( 'higer_product_term' ) ) {
	/** اولین مقدار یک ویژگی سراسری برای محصول. */
	function higer_product_term( $product_id, $taxonomy ) {
		if ( ! $taxonomy || ! taxonomy_exists( $taxonomy ) ) {
			return null;
		}
		$terms = wc_get_product_terms( $product_id, $taxonomy, array( 'fields' => 'all' ) );
		return ( is_array( $terms ) && ! empty( $terms ) ) ? $terms[0] : null;
	}
}

if ( ! function_exists( 'higer_product_terms' ) ) {
	/** همه مقادیر یک ویژگی سراسری برای محصول. */
	function higer_product_terms( $product_id, $taxonomy ) {
		if ( ! $taxonomy || ! taxonomy_exists( $taxonomy ) ) {
			return array();
		}
		$terms = wc_get_product_terms( $product_id, $taxonomy, array( 'fields' => 'all' ) );
		return is_array( $terms ) ? array_values( array_filter( $terms, 'is_object' ) ) : array();
	}
}

if ( ! function_exists( 'higer_product_details' ) ) {
	/**
	 * نوع فنر، لایه ویژه و جنس پارچه محصول، هر مقدار با عنوان و توضیح کوتاه.
	 * عنوان و توضیح از تنظیمات خوانده می‌شود؛ اگر نبود، از نام و توضیح همان مقدار در ووکامرس.
	 */
	function higer_product_details( $product_id, $cfg ) {
		$groups = array(
			'spring'  => array( 'label' => 'نوع فنر', 'map' => 'springs', 'icon' => 'spring' ),
			'special' => array( 'label' => 'لایه ویژه', 'map' => 'special_layers', 'icon' => 'cloud' ),
			'fabric'  => array( 'label' => 'جنس پارچه', 'map' => 'fabrics', 'icon' => 'fabric' ),
		);
		$out = array();
		foreach ( $groups as $key => $group ) {
			$taxonomy = isset( $cfg['attributes'][ $key ] ) ? $cfg['attributes'][ $key ] : '';
			$map      = isset( $cfg[ $group['map'] ] ) ? (array) $cfg[ $group['map'] ] : array();
			$items    = array();
			foreach ( higer_product_terms( $product_id, $taxonomy ) as $term ) {
				$own     = isset( $map[ $term->slug ] ) ? (array) $map[ $term->slug ] : array();
				$items[] = array(
					'slug'  => $term->slug,
					'title' => ! empty( $own['title'] ) ? $own['title'] : higer_product_fa( $term->name ),
					'text'  => ! empty( $own['text'] ) ? $own['text'] : trim( wp_strip_all_tags( (string) $term->description ) ),
				);
			}
			if ( $items ) {
				$out[ $key ] = array( 'label' => $group['label'], 'icon' => $group['icon'], 'items' => $items, 'value' => implode( '، ', wp_list_pluck( $items, 'title' ) ) );
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'higer_product_firmness_scale' ) ) {
	/** همه سطوح سفتی ثبت‌شده در فروشگاه، به ترتیب عدد انتهای نامک. */
	function higer_product_firmness_scale( $taxonomy ) {
		static $cache = array();
		if ( isset( $cache[ $taxonomy ] ) ) {
			return $cache[ $taxonomy ];
		}
		$scale = array();
		if ( taxonomy_exists( $taxonomy ) ) {
			$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => false ) );
			if ( is_array( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( preg_match( '/(\d+)$/', $term->slug, $m ) ) {
						$scale[ (int) $m[1] ] = $term->name;
					}
				}
			}
		}
		ksort( $scale );
		$cache[ $taxonomy ] = $scale;
		return $scale;
	}
}

if ( ! function_exists( 'higer_product_primary_category' ) ) {
	/** عمیق‌ترین دسته محصول و مسیر آن از ریشه. */
	function higer_product_primary_category( $product_id ) {
		$best  = null;
		$terms = wc_get_product_terms( $product_id, 'product_cat', array( 'fields' => 'all' ) );
		foreach ( (array) $terms as $term ) {
			if ( ! is_object( $term ) ) {
				continue;
			}
			$ancestors = get_ancestors( $term->term_id, 'product_cat', 'taxonomy' );
			if ( null === $best || count( $ancestors ) > count( $best['ancestors'] ) ) {
				$best = array( 'term' => $term, 'ancestors' => $ancestors );
			}
		}
		if ( ! $best ) {
			return null;
		}
		$path = array();
		foreach ( array_reverse( $best['ancestors'] ) as $ancestor_id ) {
			$ancestor = get_term( $ancestor_id, 'product_cat' );
			if ( $ancestor && ! is_wp_error( $ancestor ) ) {
				$path[] = $ancestor;
			}
		}
		$path[] = $best['term'];
		return array( 'term' => $best['term'], 'path' => $path );
	}
}

if ( ! function_exists( 'higer_product_core_for' ) ) {
	function higer_product_core_for( $path, $cfg ) {
		foreach ( array_reverse( (array) $path ) as $term ) {
			if ( isset( $cfg['cores'][ $term->slug ] ) ) {
				return $cfg['cores'][ $term->slug ] + array( 'term' => $term );
			}
		}
		return null;
	}
}

if ( ! function_exists( 'higer_product_term_url' ) ) {
	function higer_product_term_url( $term ) {
		$url = $term ? get_term_link( $term, 'product_cat' ) : '';
		return ( ! $url || is_wp_error( $url ) ) ? '' : $url;
	}
}

if ( ! function_exists( 'higer_product_extra_attributes' ) ) {
	/** ویژگی‌های قابل نمایش محصول، به‌جز سایز، سفتی، گارانتی و چیدمان لایه‌ها. */
	function higer_product_extra_attributes( $item, $keys ) {
		$out = array();
		foreach ( (array) $item->get_attributes() as $attribute ) {
			if ( ! is_object( $attribute ) || ! $attribute->get_visible() || in_array( $attribute->get_name(), $keys, true ) ) {
				continue;
			}
			$values = $attribute->is_taxonomy() ? wp_list_pluck( (array) $attribute->get_terms(), 'name' ) : (array) $attribute->get_options();
			if ( $values ) {
				$out[] = array( 'label' => wc_attribute_label( $attribute->get_name(), $item ), 'value' => implode( '، ', $values ) );
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'higer_product_brief' ) ) {
	/**
	 * خلاصه یک محصول برای مقایسه و محصولات مرتبط.
	 * با $full = true سایزها، قیمت هر سایز، دسته‌ها، موجودی و سایر ویژگی‌ها هم خوانده می‌شوند.
	 */
	function higer_product_brief( $item, $cfg, $full = false ) {
		$keys     = $cfg['attributes'];
		$id       = (int) $item->get_id();
		$firm     = higer_product_term( $id, $keys['firmness'] );
		$warranty = higer_product_term( $id, $keys['warranty'] );
		$layer    = higer_product_term( $id, $keys['layer'] );
		$category = higer_product_primary_category( $id );
		$variable = $item->is_type( 'variable' );
		$min      = $variable ? $item->get_variation_price( 'min', true ) : wc_get_price_to_display( $item );
		$max      = $variable ? $item->get_variation_price( 'max', true ) : $min;
		$image_id = (int) $item->get_image_id();
		$image    = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : '';
		$b        = array(
			'id'         => $id,
			'name'       => $item->get_name(),
			'url'        => $item->get_permalink(),
			'firm'       => $firm ? $firm->name : '',
			'firm_level' => ( $firm && preg_match( '/(\d+)$/', $firm->slug, $m ) ) ? (int) $m[1] : 0,
			'warranty'   => $warranty ? $warranty->name : '',
			'layer'      => $layer ? $layer->name : '',
			'details'    => higer_product_details( $id, $cfg ),
			'min'        => (float) $min,
			'max'        => (float) $max,
			'category'   => $category ? $category['term']->name : '',
			'core'       => $category ? higer_product_core_for( $category['path'], $cfg ) : null,
			'image'      => $image ? $image : '',
		);
		if ( ! $full ) {
			return $b;
		}

		$b['in_stock'] = (bool) $item->is_in_stock();
		$b['extra']    = higer_product_extra_attributes( $item, $keys );

		/* همه دسته‌های محصول به‌همراه دسته‌های والد */
		$b['cats'] = array();
		foreach ( (array) wc_get_product_terms( $id, 'product_cat', array( 'fields' => 'all' ) ) as $term ) {
			if ( is_object( $term ) ) {
				$b['cats'][] = (int) $term->term_id;
				foreach ( (array) get_ancestors( $term->term_id, 'product_cat', 'taxonomy' ) as $ancestor ) {
					$b['cats'][] = (int) $ancestor;
				}
			}
		}
		$b['cats'] = array_values( array_unique( $b['cats'] ) );

		/* سایزها و قیمت هر سایز */
		$size_tax   = $keys['size'];
		$b['sizes'] = array();
		if ( taxonomy_exists( $size_tax ) ) {
			foreach ( (array) wc_get_product_terms( $id, $size_tax, array( 'fields' => 'all' ) ) as $term ) {
				$b['sizes'][ $term->slug ] = higer_product_size_text( $term->slug, $term->name );
			}
			uksort( $b['sizes'], 'higer_product_size_compare' );
		}
		$b['prices'] = array();
		if ( $variable && function_exists( 'wc_get_product_variation_attributes' ) ) {
			$list = $item->get_variation_prices( true );
			$list = isset( $list['price'] ) ? (array) $list['price'] : array();
			if ( $list && function_exists( 'update_meta_cache' ) ) {
				update_meta_cache( 'post', array_map( 'intval', array_keys( $list ) ) );
			}
			$any = null;
			foreach ( $list as $variation_id => $price ) {
				$attrs = wc_get_product_variation_attributes( (int) $variation_id );
				$size  = isset( $attrs[ 'attribute_' . $size_tax ] ) ? (string) $attrs[ 'attribute_' . $size_tax ] : '';
				$price = (float) $price;
				if ( '' === $size ) {
					$any = ( null === $any ) ? $price : min( $any, $price );
				} elseif ( ! isset( $b['prices'][ $size ] ) || $price < $b['prices'][ $size ] ) {
					$b['prices'][ $size ] = $price;
				}
			}
			if ( null !== $any ) {
				foreach ( array_keys( $b['sizes'] ) as $size ) {
					if ( ! isset( $b['prices'][ $size ] ) ) {
						$b['prices'][ $size ] = $any;
					}
				}
			}
		}
		return $b;
	}
}

if ( ! function_exists( 'higer_product_collect' ) ) {
	/** همه اطلاعات لازم صفحه را از ووکامرس جمع می‌کند. */
	function higer_product_collect( $product, $cfg ) {
		$id   = $product->get_id();
		$keys = $cfg['attributes'];
		$d    = array(
			'id'          => $id,
			'name'        => $product->get_name(),
			'url'         => $product->get_permalink(),
			'sku'         => (string) $product->get_sku(),
			'variable'    => $product->is_type( 'variable' ),
			'short'       => trim( wp_strip_all_tags( (string) $product->get_short_description() ) ),
			'description' => trim( (string) $product->get_description() ),
			'in_stock'    => (bool) $product->is_in_stock(),
			'purchasable' => (bool) $product->is_purchasable(),
			'rating'      => (float) $product->get_average_rating(),
			'reviews'     => (int) $product->get_review_count(),
			'min_qty'     => max( 1, (int) $product->get_min_purchase_quantity() ),
			'max_qty'     => (int) $product->get_max_purchase_quantity(),
		);

		$d['category'] = higer_product_primary_category( $id );
		$d['core']     = $d['category'] ? higer_product_core_for( $d['category']['path'], $cfg ) : null;

		/* سفتی، گارانتی و چیدمان لایه‌ها */
		$d['firmness'] = null;
		$firm          = higer_product_term( $id, $keys['firmness'] );
		if ( $firm ) {
			$scale = higer_product_firmness_scale( $keys['firmness'] );
			$level = preg_match( '/(\d+)$/', $firm->slug, $m ) ? (int) $m[1] : 0;
			$d['firmness'] = array(
				'name'  => $firm->name,
				'level' => $level,
				'max'   => $scale ? max( array_keys( $scale ) ) : 0,
				'scale' => $scale,
			);
		}
		$warranty      = higer_product_term( $id, $keys['warranty'] );
		$d['warranty'] = $warranty ? $warranty->name : '';
		$layer         = higer_product_term( $id, $keys['layer'] );
		$d['layer']    = $layer ? array(
			'slug' => $layer->slug,
			'name' => $layer->name,
			'text' => isset( $cfg['layers'][ $layer->slug ] ) ? $cfg['layers'][ $layer->slug ] : '',
		) : null;

		$d['details'] = higer_product_details( $id, $cfg );
		$d['extra']   = higer_product_extra_attributes( $product, $keys );

		/* گزینه‌ها و متغیرها */
		$d['options']    = array();
		$d['variations'] = array();
		$d['defaults']   = array();
		if ( $d['variable'] ) {
			foreach ( (array) $product->get_variation_attributes() as $name => $values ) {
				$key    = sanitize_title( $name );
				$values = array_values( array_filter( array_map( 'strval', (array) $values ), 'strlen' ) );
				$labels = array();
				if ( taxonomy_exists( $name ) ) {
					foreach ( (array) wc_get_product_terms( $id, $name, array( 'fields' => 'all' ) ) as $term ) {
						if ( in_array( $term->slug, $values, true ) ) {
							$labels[ $term->slug ] = $term->name;
						}
					}
				}
				foreach ( $values as $value ) {
					if ( ! isset( $labels[ $value ] ) ) {
						$labels[ $value ] = $value;
					}
				}
				$is_size = ( $name === $keys['size'] );
				if ( $is_size ) {
					uksort( $labels, 'higer_product_size_compare' );
				}
				$d['options'][ $key ] = array(
					'name'    => $name,
					'label'   => wc_attribute_label( $name, $product ),
					'is_size' => $is_size,
					'values'  => $labels,
				);
			}
			foreach ( (array) $product->get_available_variations() as $v ) {
				if ( isset( $v['variation_is_active'] ) && ! $v['variation_is_active'] ) {
					continue;
				}
				$attrs = array();
				foreach ( (array) $v['attributes'] as $k => $value ) {
					$attrs[ preg_replace( '/^attribute_/', '', $k ) ] = (string) $value;
				}
				$price   = (float) $v['display_price'];
				$regular = isset( $v['display_regular_price'] ) ? (float) $v['display_regular_price'] : $price;
				$d['variations'][] = array(
					'id'          => (int) $v['variation_id'],
					'attrs'       => $attrs,
					'price'       => $price,
					'priceText'   => higer_product_money( $price ),
					'regularText' => $regular > $price ? higer_product_money( $regular ) : '',
					'inStock'     => ! empty( $v['is_in_stock'] ),
					'purchasable' => ! isset( $v['is_purchasable'] ) || ! empty( $v['is_purchasable'] ),
					'maxQty'      => ( isset( $v['max_qty'] ) && '' !== $v['max_qty'] ) ? (int) $v['max_qty'] : 0,
				);
			}
			foreach ( (array) $product->get_default_attributes() as $name => $value ) {
				if ( '' !== (string) $value ) {
					$d['defaults'][ sanitize_title( $name ) ] = (string) $value;
				}
			}
			$min = (float) $product->get_variation_price( 'min', true );
			$max = (float) $product->get_variation_price( 'max', true );
		} else {
			$min = (float) wc_get_price_to_display( $product );
			$max = $min;
		}
		$d['min']        = $min;
		$d['max']        = $max;
		$d['regular']    = ( ! $d['variable'] && $product->is_on_sale() ) ? (float) wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) : 0;
		$d['range_text'] = $min > 0 ? ( $max > $min ? higer_product_number( $min ) . ' تا ' . higer_product_money( $max ) : higer_product_money( $min ) ) : '';

		/* کمترین قیمت و موجودی هر گزینه (برای دکمه‌های سایز و جدول قیمت) */
		foreach ( $d['options'] as $key => $option ) {
			$d['options'][ $key ]['from']  = array();
			$d['options'][ $key ]['stock'] = array();
			foreach ( $option['values'] as $value => $label ) {
				$best  = null;
				$stock = false;
				foreach ( $d['variations'] as $variation ) {
					$own = isset( $variation['attrs'][ $key ] ) ? $variation['attrs'][ $key ] : '';
					if ( '' !== $own && $own !== (string) $value ) {
						continue;
					}
					if ( null === $best || $variation['price'] < $best ) {
						$best = $variation['price'];
					}
					if ( $variation['inStock'] ) {
						$stock = true;
					}
				}
				$d['options'][ $key ]['from'][ $value ]  = $best;
				$d['options'][ $key ]['stock'][ $value ] = $stock;
			}
		}

		/* تصاویر */
		$d['images'] = array();
		$image_ids   = array_merge( array( (int) $product->get_image_id() ), array_map( 'intval', (array) $product->get_gallery_image_ids() ) );
		foreach ( array_unique( array_filter( $image_ids ) ) as $image_id ) {
			$src = wp_get_attachment_image_url( $image_id, 'woocommerce_single' );
			if ( ! $src ) {
				continue;
			}
			$thumb         = wp_get_attachment_image_url( $image_id, 'woocommerce_gallery_thumbnail' );
			$alt           = trim( (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
			$d['images'][] = array( 'src' => $src, 'thumb' => $thumb ? $thumb : $src, 'alt' => '' !== $alt ? $alt : $d['name'] );
		}
		return $d;
	}
}

if ( ! function_exists( 'higer_product_sort_by_price' ) ) {
	function higer_product_sort_by_price( $a, $b ) {
		if ( $a['min'] == $b['min'] ) { // phpcs:ignore
			return strcmp( $a['name'], $b['name'] );
		}
		return $a['min'] < $b['min'] ? -1 : 1;
	}
}

if ( ! function_exists( 'higer_product_compare_pool' ) ) {
	/**
	 * مدل‌های قابل مقایسه.
	 * همه محصولات موجودِ دسته اصلی (مثلاً «تشک») بارگذاری می‌شوند تا هر مدلی قابل افزودن به مقایسه باشد.
	 * محصولات ناموجود کنار گذاشته می‌شوند؛ محصول همین صفحه همیشه به‌عنوان مرجع می‌ماند.
	 * جدول به‌صورت پیش‌فرض مدل‌های عمیق‌ترین دسته‌ای را نشان می‌دهد که دست‌کم دو مدل موجود دارد.
	 */
	function higer_product_compare_pool( $product, $d, $cfg ) {
		$out = array( 'term' => null, 'rows' => array(), 'defaults' => array() );
		if ( empty( $d['category'] ) || ! function_exists( 'wc_get_products' ) ) {
			return $out;
		}
		$root   = $d['category']['path'][0];
		$hours  = isset( $cfg['compare_cache'] ) ? (float) $cfg['compare_cache'] : 0;
		$key    = '';
		$cached = false;
		if ( $hours > 0 && function_exists( 'get_transient' ) ) {
			$version = class_exists( 'WC_Cache_Helper' ) ? WC_Cache_Helper::get_transient_version( 'product' ) : '';
			$key     = 'higer_cmp_' . md5( wp_json_encode( array( 3, $root->term_id, $version, $cfg['attributes'], $cfg['cores'], $cfg['springs'], $cfg['special_layers'], $cfg['fabrics'], (int) $cfg['compare_limit'] ) ) );
			$cached  = get_transient( $key );
		}
		if ( is_array( $cached ) ) {
			$rows = $cached;
		} else {
			$rows  = array();
			$items = wc_get_products( array(
				'status'     => 'publish',
				'limit'      => max( 2, (int) $cfg['compare_limit'] ),
				'category'   => array( $root->slug ),
				'visibility' => 'catalog',
			) );
			foreach ( $items as $item ) {
				$row = higer_product_brief( $item, $cfg, true );
				if ( $row['in_stock'] ) {
					$rows[ $row['id'] ] = $row;
				}
			}
			if ( $key ) {
				set_transient( $key, $rows, (int) round( $hours * 3600 ) );
			}
		}
		$current = (int) $product->get_id();
		if ( ! isset( $rows[ $current ] ) ) {
			$rows[ $current ] = higer_product_brief( $product, $cfg, true );
		}
		if ( count( $rows ) < 2 ) {
			return $out;
		}
		uasort( $rows, 'higer_product_sort_by_price' );

		$term  = $d['category']['term'];
		$group = array();
		while ( $term ) {
			$group = array();
			foreach ( $rows as $id => $row ) {
				if ( in_array( (int) $term->term_id, $row['cats'], true ) ) {
					$group[] = (int) $id;
				}
			}
			if ( count( $group ) >= 2 || empty( $term->parent ) ) {
				break;
			}
			$parent = get_term( (int) $term->parent, 'product_cat' );
			$term   = ( $parent && ! is_wp_error( $parent ) ) ? $parent : null;
		}
		if ( ! $term || count( $group ) < 2 ) {
			$term  = $root;
			$group = array_map( 'intval', array_keys( $rows ) );
		}
		return array( 'term' => $term, 'rows' => $rows, 'defaults' => $group );
	}
}

if ( ! function_exists( 'higer_product_related_items' ) ) {
	function higer_product_related_items( $product, $cfg ) {
		$items = array();
		if ( empty( $cfg['show_related'] ) || ! function_exists( 'wc_get_related_products' ) ) {
			return $items;
		}
		foreach ( (array) wc_get_related_products( $product->get_id(), 4 ) as $related_id ) {
			$related = wc_get_product( $related_id );
			if ( $related && $related->is_visible() ) {
				$items[] = higer_product_brief( $related, $cfg );
			}
		}
		return $items;
	}
}

if ( ! function_exists( 'higer_product_icon' ) ) {
	function higer_product_icon( $name, $size = 18 ) {
		static $paths = array(
			'shield'        => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
			'card'          => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/>',
			'truck'         => '<path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>',
			'phone'         => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'layers'        => '<path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>',
			'ruler'         => '<path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/>',
			'gauge'         => '<path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
			'cart'          => '<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>',
			'plus'          => '<path d="M5 12h14"/><path d="M12 5v14"/>',
			'minus'         => '<path d="M5 12h14"/>',
			'chevron-left'  => '<path d="m15 18-6-6 6-6"/>',
			'chevron-right' => '<path d="m9 18 6-6-6-6"/>',
			'star'          => '<path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>',
			'sparkles'      => '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>',
			'map'           => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
			'clock'         => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
			'table'         => '<path d="M12 3v18"/><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/>',
			'bed'           => '<path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"/><path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/><path d="M12 4v6"/><path d="M2 18h20"/>',
			'check'         => '<path d="M20 6 9 17l-5-5"/>',
			'compare'       => '<path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/>',
			'spring'        => '<path d="M6 3h12"/><path d="M6 21h12"/><path d="M7 3l10 3-10 3 10 3-10 3 10 3-3 3"/>',
			'cloud'         => '<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>',
			'fabric'        => '<path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>',
			'tag'           => '<path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"/><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"/>',
		);
		if ( ! isset( $paths[ $name ] ) ) {
			return '';
		}
		$size = (int) $size;
		return '<svg class="hp-i" xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
	}
}

if ( ! function_exists( 'higer_product_core_svg' ) ) {
	/** طرح شماتیک هسته (بدون نیاز به عکس). */
	function higer_product_core_svg( $key ) {
		$out = '';
		switch ( $key ) {
			case 'bonnell':
				$out .= '<rect x="14" y="30" width="292" height="10" rx="5" fill="#f3d98b" opacity=".9"/><rect x="14" y="140" width="292" height="10" rx="5" fill="#f3d98b" opacity=".9"/>';
				for ( $i = 0; $i < 7; $i++ ) {
					$x    = 38 + $i * 41;
					$out .= '<g fill="none" stroke="#e7b95c" stroke-width="2.4" stroke-linejoin="round"><ellipse cx="' . $x . '" cy="50" rx="15" ry="5" fill="rgba(217,161,59,.22)"/><path d="M' . ( $x - 15 ) . ' 50 L' . ( $x - 4 ) . ' 74 L' . ( $x + 9 ) . ' 90 L' . ( $x - 9 ) . ' 106 L' . ( $x + 4 ) . ' 122 L' . ( $x + 15 ) . ' 130"/><ellipse cx="' . $x . '" cy="130" rx="15" ry="5" fill="rgba(217,161,59,.22)"/></g>';
				}
				$out .= '<path d="M23 50 H297 M23 130 H297" stroke="#d9a13b" stroke-width="1.4" opacity=".55"/>';
				break;
			case 'pocket':
				$out .= '<rect x="12" y="22" width="296" height="136" rx="14" fill="none" stroke="#f3d98b" stroke-width="2" stroke-dasharray="6 5" opacity=".6"/>';
				for ( $i = 0; $i < 7; $i++ ) {
					$x    = 24 + $i * 40;
					$out .= '<rect x="' . $x . '" y="34" width="32" height="112" rx="12" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.8"/><path d="M' . ( $x + 8 ) . ' 46 L' . ( $x + 24 ) . ' 58 L' . ( $x + 8 ) . ' 70 L' . ( $x + 24 ) . ' 82 L' . ( $x + 8 ) . ' 94 L' . ( $x + 24 ) . ' 106 L' . ( $x + 8 ) . ' 118 L' . ( $x + 24 ) . ' 132" fill="none" stroke="#d9a13b" stroke-width="2"/>';
				}
				break;
			case 'rebond':
				$out  .= '<rect x="14" y="30" width="292" height="120" rx="16" fill="rgba(138,109,59,.3)" stroke="#e7b95c" stroke-width="2"/>';
				$chips = array( array( 40, 52, 8, '#d9a13b' ), array( 74, 96, 6, '#f3d98b' ), array( 102, 60, 9, '#8a6d3b' ), array( 132, 118, 7, '#d9a13b' ), array( 160, 70, 6, '#f3d98b' ), array( 186, 128, 8, '#a86f1c' ), array( 214, 58, 7, '#e7b95c' ), array( 244, 104, 9, '#8a6d3b' ), array( 272, 64, 6, '#d9a13b' ), array( 286, 128, 7, '#f3d98b' ), array( 52, 130, 7, '#a86f1c' ), array( 118, 84, 5, '#e7b95c' ), array( 206, 92, 5, '#d9a13b' ), array( 258, 138, 5, '#f3d98b' ), array( 88, 136, 5, '#e7b95c' ), array( 150, 42, 5, '#a86f1c' ), array( 30, 92, 6, '#e7b95c' ), array( 232, 136, 6, '#d9a13b' ) );
				foreach ( $chips as $c ) {
					$out .= '<circle cx="' . $c[0] . '" cy="' . $c[1] . '" r="' . $c[2] . '" fill="' . $c[3] . '" opacity=".9"/>';
				}
				break;
			case 'foam':
				$out .= '<path d="M14 40 C 90 26, 230 54, 306 40 L306 76 C 230 90, 90 62, 14 76 Z" fill="rgba(91,122,78,.45)" stroke="#a8c793" stroke-width="1.8"/>';
				$out .= '<path d="M14 84 C 90 70, 230 98, 306 84 L306 116 C 230 130, 90 102, 14 116 Z" fill="rgba(217,161,59,.25)" stroke="#e7b95c" stroke-width="1.8"/>';
				$out .= '<path d="M14 124 C 90 110, 230 138, 306 124 L306 146 C 230 160, 90 132, 14 146 Z" fill="rgba(243,217,139,.16)" stroke="#f3d98b" stroke-width="1.6"/>';
				break;
			default:
				$out .= '<rect x="34" y="52" width="252" height="24" rx="12" fill="rgba(243,217,139,.25)" stroke="#f3d98b" stroke-width="2"/>';
				$out .= '<rect x="20" y="84" width="280" height="64" rx="16" fill="rgba(217,161,59,.12)" stroke="#e7b95c" stroke-width="2"/>';
				$out .= '<path d="M50 102 H270 M50 117 H270 M50 132 H270" stroke="#e7b95c" stroke-width="1.2" opacity=".5"/>';
		}
		return '<svg class="hp-core-svg" viewBox="0 0 320 180" aria-hidden="true" focusable="false">' . $out . '</svg>';
	}
}

if ( ! function_exists( 'higer_product_detail_svg' ) ) {
	/** طرح شماتیک نوع فنر، لایه ویژه و جنس پارچه (بدون نیاز به عکس). */
	function higer_product_detail_svg( $group, $slug ) {
		$out = '';
		if ( 'spring' === $group ) {
			if ( false !== strpos( $slug, 'micro' ) ) {
				/* فنرهای کوچک و متراکم در دو ردیف */
				$out .= '<rect x="14" y="44" width="292" height="8" rx="4" fill="#f3d98b" opacity=".9"/><rect x="14" y="128" width="292" height="8" rx="4" fill="#f3d98b" opacity=".9"/>';
				foreach ( array( array( 30, '.35', 0 ), array( 20, '1', 1 ) ) as $row ) {
					for ( $i = 0; $i < 14; $i++ ) {
						$x    = $row[0] + $i * 21;
						$out .= '<path d="M' . ( $x - 6 ) . ' 54 L' . ( $x + 6 ) . ' 64 L' . ( $x - 6 ) . ' 74 L' . ( $x + 6 ) . ' 84 L' . ( $x - 6 ) . ' 94 L' . ( $x + 6 ) . ' 104 L' . ( $x - 6 ) . ' 114 L' . ( $x + 6 ) . ' 124" fill="none" stroke="' . ( $row[2] ? '#e7b95c' : '#8fb3d9' ) . '" stroke-width="1.6" stroke-linejoin="round" opacity="' . $row[1] . '"/>';
					}
				}
				$out .= '<path d="M14 160 H306" stroke="#f3d98b" stroke-width="1.2" opacity=".35" stroke-dasharray="3 5"/>';
			} else {
				/* فنرهای بزرگ‌تر با مفتول ضخیم‌تر و نمای بزرگ‌شده مقطع مفتول */
				$out .= '<rect x="14" y="26" width="226" height="9" rx="4.5" fill="#f3d98b" opacity=".9"/><rect x="14" y="145" width="226" height="9" rx="4.5" fill="#f3d98b" opacity=".9"/>';
				for ( $i = 0; $i < 5; $i++ ) {
					$x    = 38 + $i * 44;
					$out .= '<g fill="none" stroke="#e7b95c" stroke-width="4" stroke-linejoin="round" stroke-linecap="round"><ellipse cx="' . $x . '" cy="44" rx="16" ry="5" fill="rgba(217,161,59,.2)"/><path d="M' . ( $x - 16 ) . ' 44 L' . ( $x + 12 ) . ' 68 L' . ( $x - 12 ) . ' 90 L' . ( $x + 12 ) . ' 112 L' . ( $x + 16 ) . ' 136"/><ellipse cx="' . $x . '" cy="136" rx="16" ry="5" fill="rgba(217,161,59,.2)"/></g>';
				}
				$out .= '<circle cx="276" cy="90" r="32" fill="rgba(7,15,29,.6)" stroke="#f3d98b" stroke-width="1.6" stroke-dasharray="4 4"/><circle cx="276" cy="90" r="13" fill="#e7b95c"/><circle cx="276" cy="90" r="13" fill="none" stroke="#a86f1c" stroke-width="2"/><path d="M256 112 L282 112" stroke="#f3d98b" stroke-width="1.4"/><path d="M256 108 V116 M282 108 V116" stroke="#f3d98b" stroke-width="1.4"/><path d="M224 90 H244" stroke="#f3d98b" stroke-width="1.2" stroke-dasharray="3 3"/>';
			}
		} elseif ( 'special' === $group ) {
			$out .= '<rect x="14" y="116" width="292" height="40" rx="10" fill="#1f3e63" stroke="#2b4e77"/><path d="M30 136 H290" stroke="#3a6189" stroke-width="1.2" stroke-dasharray="5 5"/>';
			$out .= '<rect x="14" y="84" width="292" height="28" rx="8" fill="rgba(143,179,217,.28)" stroke="#8fb3d9" stroke-width="1.4"/>';
			if ( false !== strpos( $slug, 'memory' ) ) {
				/* لایه مموری با فرورفتگی آرام زیر فشار */
				$out .= '<path d="M14 40 H112 C 134 40, 142 60, 160 60 C 178 60, 186 40, 208 40 H306 V80 H14 Z" fill="rgba(231,185,92,.35)" stroke="#e7b95c" stroke-width="2"/>';
				$out .= '<path d="M112 40 H208" stroke="#f3d98b" stroke-width="1.4" stroke-dasharray="4 4" opacity=".8"/>';
				$out .= '<path d="M160 10 V40" stroke="#f3d98b" stroke-width="2.2" stroke-linecap="round"/><path d="M152 32 L160 42 L168 32" fill="none" stroke="#f3d98b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>';
				$out .= '<path d="M222 22 C 236 18, 248 18, 262 22" fill="none" stroke="#e7b95c" stroke-width="1.6" stroke-dasharray="3 4" opacity=".8"/><path d="M256 16 L263 22 L255 27" fill="none" stroke="#e7b95c" stroke-width="1.6" opacity=".8"/>';
			} else {
				/* لایه ابر رویی با بافت متخلخل */
				$out .= '<rect x="14" y="40" width="292" height="40" rx="10" fill="rgba(231,185,92,.3)" stroke="#e7b95c" stroke-width="2"/>';
				for ( $i = 0; $i < 13; $i++ ) {
					for ( $r = 0; $r < 2; $r++ ) {
						$out .= '<circle cx="' . ( 30 + $i * 22 + ( $r ? 11 : 0 ) ) . '" cy="' . ( 53 + $r * 14 ) . '" r="' . ( ( $i + $r ) % 2 ? 3 : 4.5 ) . '" fill="#f3d98b" opacity=".55"/>';
					}
				}
			}
		} else {
			if ( false !== strpos( $slug, 'knit' ) ) {
				/* بافت حلقوی: ردیف‌های حلقه‌های V شکل درهم‌رفته */
				for ( $r = 0; $r < 5; $r++ ) {
					$y = 30 + $r * 26;
					for ( $c = 0; $c < 10; $c++ ) {
						$x    = 25 + $c * 27;
						$op   = ( $r + $c ) % 2 ? '.75' : '1';
						$out .= '<path d="M' . $x . ' ' . $y . ' C ' . ( $x + 1 ) . ' ' . ( $y + 16 ) . ', ' . ( $x + 9 ) . ' ' . ( $y + 24 ) . ', ' . ( $x + 12 ) . ' ' . ( $y + 26 ) . '" fill="none" stroke="#e7b95c" stroke-width="3" stroke-linecap="round" opacity="' . $op . '"/>';
						$out .= '<path d="M' . ( $x + 24 ) . ' ' . $y . ' C ' . ( $x + 23 ) . ' ' . ( $y + 16 ) . ', ' . ( $x + 15 ) . ' ' . ( $y + 24 ) . ', ' . ( $x + 12 ) . ' ' . ( $y + 26 ) . '" fill="none" stroke="#f3d98b" stroke-width="3" stroke-linecap="round" opacity="' . $op . '"/>';
					}
				}
			} else {
				/* بافت تاری‌پودی */
				for ( $i = 0; $i < 8; $i++ ) {
					$out .= '<rect x="14" y="' . ( 24 + $i * 17 ) . '" width="292" height="9" rx="4.5" fill="#e7b95c" opacity="' . ( $i % 2 ? '.55' : '.9' ) . '"/>';
				}
				for ( $i = 0; $i < 18; $i++ ) {
					$out .= '<rect x="' . ( 20 + $i * 16 ) . '" y="20" width="7" height="140" rx="3.5" fill="#8fb3d9" opacity=".55"/>';
				}
			}
		}
		return '<svg class="hp-detail-svg" viewBox="0 0 320 180" aria-hidden="true" focusable="false">' . $out . '</svg>';
	}
}

if ( ! function_exists( 'higer_product_layer_svg' ) ) {
	function higer_product_layer_svg( $slug ) {
		$bottom = '';
		if ( 'double-sided-same' === $slug ) {
			$bottom = '<rect x="8" y="70" width="144" height="16" rx="8" fill="#e7b95c"/>';
		} elseif ( 'double-sided-dual' === $slug ) {
			$bottom = '<rect x="8" y="70" width="144" height="16" rx="8" fill="#8fb3d9"/>';
		}
		$height = $bottom ? 94 : 74;
		return '<svg class="hp-layer-svg" viewBox="0 0 160 ' . $height . '" aria-hidden="true" focusable="false"><rect x="8" y="8" width="144" height="16" rx="8" fill="#e7b95c"/><rect x="8" y="30" width="144" height="34" rx="10" fill="#1f3e63" stroke="#2b4e77"/>' . $bottom . '</svg>';
	}
}

if ( ! function_exists( 'higer_product_assets' ) ) {
	/** استایل و اسکریپت فقط یک بار در هر صفحه چاپ می‌شوند. */
	function higer_product_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		ob_start();
		?>
<style id="higer-product-css">
/* ================== هیگر — استایل صفحه محصول (نسخه بدون بیلد) ================== */
.higer-product{
  --hp-navy-950:#070f1d;--hp-navy-900:#10243e;--hp-navy-800:#183250;--hp-navy-700:#1f3e63;--hp-navy-600:#2b4e77;
  --hp-gold-600:#c8892a;--hp-gold-500:#d9a13b;--hp-gold-400:#e7b95c;--hp-gold-300:#f3d98b;--hp-gold-200:#f8ead0;
  --hp-cream:#faf7ef;--hp-paper:#f3efe3;--hp-line:#e3ddcd;--hp-ok:#047857;--hp-bad:#b91c1c;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--hp-navy-900);background:var(--hp-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-product *,.higer-product *::before,.higer-product *::after{box-sizing:border-box}
.higer-product :is(h1,h2,h3,h4,p,ul,ol,figure,table,dl,dd){margin:0;padding:0;border:0}
.higer-product :is(h1,h2,h3,h4){font-family:inherit;color:inherit;letter-spacing:normal;text-transform:none;font-weight:900;line-height:1.5}
.higer-product :is(ul,ol){list-style:none}
.higer-product a{color:inherit;text-decoration:none;background:none}
.higer-product button{font:inherit;color:inherit;background:none;border:0;border-radius:0;padding:0;margin:0;cursor:pointer;text-transform:none;letter-spacing:normal;box-shadow:none;line-height:inherit;min-height:0;width:auto;white-space:normal;text-align:inherit;user-select:auto}
.higer-product img{display:block;max-width:100%;height:auto;border:0}
.higer-product svg{flex:none}
.higer-product .hp-i{display:inline-block;vertical-align:middle}
.higer-product [hidden]{display:none!important}
.higer-product :focus-visible{outline:3px solid var(--hp-gold-600);outline-offset:3px}
.higer-product .hp-wrap{width:100%;max-width:1280px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-product .hp-wrap{padding-inline:24px}}
.higer-product .hp-narrow{max-width:880px}
.higer-product .hp-sr{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
.higer-product .hp-muted{font-size:12px;font-weight:700;color:var(--hp-navy-600)}

/* ---------- تیترها و برچسب‌ها ---------- */
.higer-product .hp-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.75);color:var(--hp-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800;line-height:1.6}
.higer-product a.hp-kicker:hover{border-color:var(--hp-gold-500);background:#fff;color:var(--hp-gold-600)}
.higer-product .hp-kicker.is-dark{background:rgba(7,15,29,.5);color:var(--hp-gold-300);border-color:rgba(217,161,59,.4)}
.higer-product .hp-h2{margin-top:12px;font-size:24px;line-height:1.55;color:var(--hp-navy-900)}
@media(min-width:640px){.higer-product .hp-h2{font-size:30px}}
.higer-product .hp-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-product .hp-lead{margin-top:8px;font-size:14px;line-height:2;color:var(--hp-navy-700)}
.higer-product .hp-head{max-width:760px;margin-bottom:28px}
.higer-product .hp-center{margin-inline:auto;text-align:center}
.higer-product .hp-sec{padding-block:56px}
@media(min-width:1024px){.higer-product .hp-sec{padding-block:80px}}
.higer-product .hp-paper{background-color:var(--hp-paper);background-image:radial-gradient(ellipse 80% 60% at 70% -10%,rgba(217,161,59,.14),transparent),radial-gradient(ellipse 60% 50% at 0% 110%,rgba(16,36,62,.08),transparent)}

/* ---------- دکمه‌ها ---------- */
.higer-product :is(a,button).hp-btn-gold{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:8px;overflow:hidden;border:0;border-radius:9999px;padding:14px 24px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hp-navy-900);font-size:14px;font-weight:900;line-height:1.4;white-space:nowrap;box-shadow:0 10px 26px rgba(217,161,59,.38),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .25s,filter .25s,box-shadow .25s}
.higer-product :is(a,button).hp-btn-gold:is(:hover,:focus){background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hp-navy-900)}
.higer-product :is(a,button).hp-btn-gold:hover{transform:translateY(-2px);filter:brightness(1.04)}
.higer-product :is(a,button).hp-btn-gold::after{content:"";position:absolute;top:-60%;inset-inline-start:-80%;width:55%;height:220%;background:linear-gradient(105deg,transparent,rgba(255,255,255,.75),transparent);transform:skewX(-18deg);animation:hp-shimmer 3.6s ease-in-out infinite;pointer-events:none}
.higer-product button.hp-btn-gold:disabled{cursor:not-allowed;opacity:.5;filter:grayscale(.5);transform:none;box-shadow:none}
.higer-product button.hp-btn-gold:disabled::after{display:none}
@keyframes hp-shimmer{0%,55%{inset-inline-start:-90%}100%{inset-inline-start:140%}}
.higer-product a.hp-btn-outline{display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(243,217,139,.45);color:var(--hp-gold-300);border-radius:9999px;padding:10px 18px;font-size:12px;font-weight:800;transition:background .25s,border-color .25s}
.higer-product a.hp-btn-outline:hover{background:rgba(243,217,139,.1);border-color:rgba(243,217,139,.8);color:var(--hp-gold-300)}

/* ---------- مسیر صفحه و پیام‌ها ---------- */
.higer-product .hp-crumbs{background:var(--hp-cream);border-bottom:1px solid var(--hp-line)}
.higer-product .hp-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:var(--hp-navy-600)}
.higer-product .hp-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-product .hp-crumbs li+li::before{content:"‹";color:var(--hp-gold-500);font-weight:900}
.higer-product .hp-crumbs a:hover{color:var(--hp-gold-600)}
.higer-product .hp-crumbs [aria-current]{color:var(--hp-navy-900);font-weight:900}
.higer-product .hp-notices{padding-top:16px}
.higer-product .hp-notices :is(.woocommerce-message,.woocommerce-info,.woocommerce-error){display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin:0 0 8px;padding:14px 18px;border:1px solid var(--hp-line);border-radius:16px;background:#fff;font-size:13px;font-weight:700;list-style:none;box-shadow:0 10px 24px rgba(16,36,62,.06)}
.higer-product .hp-notices .woocommerce-error{border-color:rgba(185,28,28,.35)}
.higer-product .hp-notices a{display:inline-flex;border-radius:9999px;background:var(--hp-navy-900);color:var(--hp-gold-300);padding:7px 14px;font-size:12px;font-weight:900}

/* ---------- بالای صفحه ---------- */
.higer-product .hp-top{padding-block:24px 48px;background-color:var(--hp-paper);background-image:radial-gradient(ellipse 80% 60% at 70% -10%,rgba(217,161,59,.16),transparent),radial-gradient(ellipse 60% 50% at 0% 110%,rgba(16,36,62,.08),transparent)}
@media(min-width:1024px){.higer-product .hp-top{padding-block:36px 72px}}
.higer-product .hp-top-grid{display:grid;gap:24px;align-items:start}
@media(min-width:1024px){.higer-product .hp-top-grid{grid-template-columns:minmax(0,5fr) minmax(0,7fr);gap:32px}}

/* گالری */
.higer-product .hp-gallery{min-width:0}
.higer-product .hp-stage{position:relative;aspect-ratio:4/3;overflow:hidden;border:1px solid var(--hp-navy-800);border-radius:28px;background:radial-gradient(700px 360px at 85% -10%,rgba(217,161,59,.18),transparent 60%),linear-gradient(160deg,#0b1a30 0%,#10243e 50%,#16304f 100%);box-shadow:0 30px 70px rgba(16,36,62,.25);outline:none}
.higer-product .hp-stage::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.05) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-product .hp-slide{position:absolute;inset:0;margin:0;opacity:0;visibility:hidden;transition:opacity .4s ease,visibility .4s}
.higer-product .hp-slide.is-active{opacity:1;visibility:visible}
.higer-product .hp-slide img{width:100%;height:100%;object-fit:cover}
.higer-product .hp-slide-diagram{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;padding:32px}
.higer-product .hp-slide-diagram .hp-core-svg{width:100%;max-width:440px;height:auto}
.higer-product .hp-slide-diagram figcaption{border:1px solid rgba(217,161,59,.35);border-radius:9999px;background:rgba(7,15,29,.5);color:var(--hp-gold-300);padding:6px 14px;font-size:12px;font-weight:800}
.higer-product .hp-stage-badge{position:absolute;top:16px;right:16px;z-index:2;display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.4);border-radius:9999px;background:rgba(7,15,29,.62);color:var(--hp-gold-300);padding:6px 12px;font-size:11px;font-weight:800;backdrop-filter:blur(8px)}
.higer-product .hp-stage-nav{position:absolute;bottom:16px;left:16px;z-index:2;display:flex;gap:8px}
.higer-product button.hp-round{display:grid;place-items:center;width:40px;height:40px;border-radius:9999px;background:rgba(255,253,246,.92);color:var(--hp-navy-900);box-shadow:0 8px 20px rgba(7,15,29,.3);transition:transform .2s}
.higer-product button.hp-round:is(:hover,:focus){background:#fff;color:var(--hp-navy-900)}
.higer-product button.hp-round:hover{transform:scale(1.06)}
.higer-product .hp-thumbs{display:flex;gap:10px;margin-top:12px;padding-bottom:4px;overflow-x:auto}
.higer-product button.hp-thumb{flex:none;width:72px;height:72px;overflow:hidden;border:2px solid var(--hp-line);border-radius:16px;background:var(--hp-navy-900);padding:0;transition:border-color .2s}
.higer-product button.hp-thumb:is(:hover,:focus){border-color:var(--hp-gold-400);background:var(--hp-navy-900)}
.higer-product button.hp-thumb[aria-current="true"]{border-color:var(--hp-gold-500);box-shadow:0 8px 20px rgba(217,161,59,.3)}
.higer-product .hp-thumb img{width:100%;height:100%;object-fit:cover}
.higer-product .hp-thumb-diagram .hp-core-svg{width:100%;height:100%;padding:8px}

/* کارت خرید */
.higer-product .hp-buy{min-width:0}
.higer-product .hp-card{border:1px solid var(--hp-line);border-radius:24px;background:#fff;box-shadow:0 20px 50px rgba(16,36,62,.1)}
.higer-product .hp-buy-card{padding:20px}
@media(min-width:640px){.higer-product .hp-buy-card{padding:28px}}
.higer-product .hp-buy-tags{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:8px}
.higer-product .hp-stock{display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:800;color:var(--hp-ok)}
.higer-product .hp-stock::before{content:"";width:8px;height:8px;border-radius:50%;background:currentColor;box-shadow:0 0 0 4px rgba(4,120,87,.15)}
.higer-product .hp-stock.is-out{color:var(--hp-bad)}
.higer-product .hp-stock.is-out::before{box-shadow:0 0 0 4px rgba(185,28,28,.12)}
.higer-product .hp-title{margin-top:14px;font-size:30px;line-height:1.35;color:var(--hp-navy-900)}
@media(min-width:640px){.higer-product .hp-title{font-size:36px}}
.higer-product .hp-subtitle{margin-top:6px;font-size:14px;line-height:1.9;color:var(--hp-navy-700)}
.higer-product .hp-meta{display:flex;flex-wrap:wrap;gap:8px 16px;margin-top:10px;font-size:12px;font-weight:700;color:var(--hp-navy-600)}
.higer-product a.hp-rating{display:inline-flex;align-items:center;gap:4px;color:var(--hp-gold-600)}
.higer-product .hp-price-box{margin-top:18px;padding:16px 18px;border:1px solid var(--hp-line);border-radius:18px;background:var(--hp-cream)}
.higer-product .hp-price-label{display:block;font-size:11px;font-weight:800;color:var(--hp-navy-600)}
.higer-product .hp-price-row{display:flex;flex-wrap:wrap;align-items:baseline;gap:4px 12px;margin-top:2px}
.higer-product .hp-price{font-size:22px;font-weight:900;line-height:1.6;color:var(--hp-navy-900)}
@media(min-width:640px){.higer-product .hp-price{font-size:25px}}
.higer-product .hp-regular{font-size:13px;font-weight:700;color:#8a94a3}
.higer-product .hp-meter{display:flex;gap:4px;margin-top:8px}
.higer-product .hp-meter i{flex:1;height:6px;border-radius:9999px;background:var(--hp-line)}
.higer-product .hp-meter i.is-on{background:linear-gradient(to left,#e7b95c,#c8892a)}

/* انتخاب سایز و فرم خرید */
.higer-product .hp-opt{margin-top:20px}
.higer-product .hp-opt-head{display:flex;align-items:baseline;justify-content:space-between;gap:8px;margin-bottom:10px}
.higer-product .hp-opt-head h3{font-size:14px;color:var(--hp-navy-900)}
.higer-product .hp-opt-head span{font-size:12px;font-weight:800;color:var(--hp-gold-600)}
.higer-product .hp-choices{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px}
@media(min-width:420px){.higer-product .hp-choices{grid-template-columns:repeat(3,minmax(0,1fr))}}
.higer-product button.hp-choice{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1px;min-height:76px;padding:10px 6px;border:1.5px solid var(--hp-line);border-radius:14px;background:#fffdf6;color:var(--hp-navy-900);text-align:center;transition:border-color .2s,box-shadow .2s,transform .2s}
.higer-product button.hp-choice:is(:hover,:focus){border-color:rgba(217,161,59,.7);background:#fffdf6;color:var(--hp-navy-900)}
.higer-product button.hp-choice:hover{transform:translateY(-2px);box-shadow:0 10px 22px rgba(16,36,62,.1)}
.higer-product button.hp-choice[aria-pressed="true"]{border-color:var(--hp-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);box-shadow:0 10px 24px rgba(217,161,59,.26),inset 0 0 0 1px rgba(217,161,59,.45)}
.higer-product button.hp-choice:disabled{cursor:not-allowed;opacity:.45;transform:none;box-shadow:none}
.higer-product .hp-choice b{font-size:15px;font-weight:900;line-height:1.5}
.higer-product .hp-choice small{min-height:16px;font-size:10px;font-weight:700;line-height:1.6;color:var(--hp-navy-600)}
.higer-product .hp-choice-price{font-size:11px;font-weight:800;color:var(--hp-gold-600)}
.higer-product .hp-form-foot{display:flex;align-items:stretch;gap:10px;margin-top:18px}
.higer-product .hp-qty{display:flex;flex:none;align-items:center;overflow:hidden;border:1.5px solid var(--hp-line);border-radius:9999px;background:#fff}
.higer-product .hp-qty button{display:grid;place-items:center;width:40px;height:50px;background:transparent;color:var(--hp-navy-900)}
.higer-product .hp-qty button:is(:hover,:focus){background:var(--hp-paper);color:var(--hp-navy-900)}
.higer-product .hp-qty input.hp-qty-input[type="number"]{width:42px;height:50px;margin:0;padding:0;border:0;border-radius:0;background:transparent;box-shadow:none;text-align:center;font:inherit;font-size:15px;font-weight:900;color:var(--hp-navy-900);-moz-appearance:textfield;appearance:textfield}
.higer-product .hp-qty input.hp-qty-input::-webkit-inner-spin-button,.higer-product .hp-qty input.hp-qty-input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}
.higer-product button.hp-add{flex:1;min-width:0}
.higer-product .hp-hint{margin-top:8px;font-size:12px;font-weight:800;line-height:1.9;color:#b45309}
.higer-product .hp-hint:empty{display:none}
.higer-product .hp-hint.is-flash{animation:hp-flash .6s ease}
@keyframes hp-flash{0%,100%{transform:none}25%{transform:translateX(-6px)}75%{transform:translateX(6px)}}
.higer-product .hp-buy-links{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-top:14px}
.higer-product .hp-buy-links.is-single{grid-template-columns:1fr}
.higer-product :is(a,button).hp-link-btn{display:flex;align-items:center;justify-content:center;gap:6px;padding:11px 8px;border:1px solid var(--hp-line);border-radius:14px;background:var(--hp-cream);color:var(--hp-navy-900);font-size:12px;font-weight:800;transition:border-color .2s,background .2s}
.higer-product :is(a,button).hp-link-btn:hover{border-color:var(--hp-gold-500);background:#fff;color:var(--hp-navy-900)}
.higer-product a.hp-finder-cta{position:relative;display:flex;align-items:center;gap:12px;margin-top:12px;padding:13px 14px;overflow:hidden;border:1.5px solid rgba(217,161,59,.6);border-radius:18px;background:radial-gradient(280px 120px at 90% 0%,rgba(217,161,59,.22),transparent 70%),linear-gradient(155deg,#0b1a30 0%,#10243e 55%,#183250 100%);color:var(--hp-cream);box-shadow:0 14px 30px rgba(16,36,62,.2);transition:transform .25s,border-color .25s,box-shadow .25s}
.higer-product a.hp-finder-cta:hover{transform:translateY(-2px);border-color:var(--hp-gold-400);box-shadow:0 18px 36px rgba(16,36,62,.28);color:var(--hp-cream)}
.higer-product .hp-finder-ico{position:relative;display:grid;flex:none;place-items:center;width:44px;height:44px;border-radius:14px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 65%,#c8892a 100%);color:var(--hp-navy-900);box-shadow:0 6px 16px rgba(217,161,59,.4)}
.higer-product .hp-finder-ico::after{content:"";position:absolute;top:-3px;right:-3px;width:10px;height:10px;border:2px solid var(--hp-navy-900);border-radius:50%;background:var(--hp-gold-300);animation:hp-finder-pulse 2.2s infinite}
@keyframes hp-finder-pulse{0%,100%{box-shadow:0 0 0 0 rgba(243,217,139,.7)}65%{box-shadow:0 0 0 7px rgba(243,217,139,0)}}
.higer-product .hp-finder-copy{flex:1;min-width:0}
.higer-product .hp-finder-copy b{display:block;font-size:13px;font-weight:900;line-height:1.5;color:var(--hp-gold-300)}
.higer-product .hp-finder-copy small{display:block;margin-top:2px;font-size:11px;font-weight:700;line-height:1.7;color:rgba(250,247,239,.82)}
.higer-product .hp-finder-go{display:inline-flex;flex:none;align-items:center;gap:4px;padding:7px 12px;border-radius:9999px;background:rgba(217,161,59,.18);border:1px solid rgba(243,217,139,.4);color:var(--hp-gold-300);font-size:11px;font-weight:900;white-space:nowrap;transition:background .2s,color .2s}
.higer-product a.hp-finder-cta:hover .hp-finder-go{background:var(--hp-gold-500);color:var(--hp-navy-900);border-color:var(--hp-gold-500)}
.higer-product .hp-facts{display:grid;gap:10px;margin-top:16px;padding-top:16px;border-top:1px dashed var(--hp-line)}
.higer-product .hp-facts li{display:flex;align-items:flex-start;gap:10px;font-size:12px;line-height:1.9;color:var(--hp-navy-700)}
.higer-product .hp-facts i{display:grid;flex:none;place-items:center;width:32px;height:32px;border-radius:10px;background:var(--hp-navy-900);color:var(--hp-gold-400)}
.higer-product .hp-facts b{font-weight:900;color:var(--hp-navy-900)}

/* ---------- منوی بخش‌ها ---------- */
.higer-product .hp-tabs{position:sticky;top:var(--hp-sticky-top,var(--wp-admin--admin-bar--height,0px));z-index:40;border-block:1px solid var(--hp-line);background:rgba(250,247,239,.96);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:top .15s ease}
.higer-product .hp-tabs-inner{display:flex;gap:6px;padding-block:10px;overflow-x:auto;scrollbar-width:none}
.higer-product .hp-tabs-inner::-webkit-scrollbar{display:none}
.higer-product a.hp-tab{flex:none;padding:8px 16px;border-radius:9999px;font-size:12px;font-weight:800;color:var(--hp-navy-700);transition:background .2s,color .2s}
.higer-product a.hp-tab:hover{background:rgba(16,36,62,.06);color:var(--hp-navy-900)}
.higer-product a.hp-tab.is-active{background:var(--hp-navy-900);color:var(--hp-gold-300)}
.higer-product [data-hp-section]{scroll-margin-top:calc(var(--hp-sticky-top,var(--wp-admin--admin-bar--height,0px)) + var(--hp-tabs-h,58px) + 12px)}

/* ---------- جدول‌ها و مشخصات ---------- */
.higer-product .hp-spec-grid{display:grid;gap:20px;align-items:start}
@media(min-width:1024px){.higer-product .hp-spec-grid{grid-template-columns:minmax(0,1.4fr) minmax(0,1fr)}}
.higer-product .hp-table-card{overflow:hidden;border:1px solid var(--hp-line);border-radius:22px;background:#fff;box-shadow:0 10px 30px rgba(16,36,62,.06)}
.higer-product .hp-scroll{position:relative;overflow-x:auto}
.higer-product .hp-table{width:100%;margin:0;border-collapse:collapse;border-spacing:0;font-size:13px}
.higer-product .hp-table :is(th,td){padding:14px 18px;border:0;border-top:1px solid var(--hp-line);background:transparent;text-align:right;vertical-align:middle;line-height:1.8}
.higer-product .hp-table thead th{border-top:0;background:var(--hp-navy-900);color:var(--hp-gold-300);font-size:12px;font-weight:900;white-space:nowrap}
.higer-product .hp-table tbody tr:first-child :is(th,td){border-top:0}
.higer-product .hp-spec-table th{width:38%;background:var(--hp-cream);color:var(--hp-navy-600);font-weight:800}
.higer-product .hp-spec-table td{font-weight:800;color:var(--hp-navy-900)}
.higer-product .hp-table a{color:var(--hp-navy-700);text-decoration:underline;text-underline-offset:3px}
.higer-product .hp-table a:hover{color:var(--hp-gold-600)}
.higer-product .hp-size-table{min-width:600px}
.higer-product .hp-compare-table :is(th,td){padding:13px 14px;white-space:nowrap}
.higer-product .hp-size-table td{font-weight:700}
.higer-product .hp-size-table tr.is-selected td{background:#fdf3d8}
.higer-product .hp-here{display:inline-flex;margin-inline-start:6px;padding:2px 8px;border-radius:9999px;background:var(--hp-gold-500);color:var(--hp-navy-900);font-size:10px;font-weight:900;vertical-align:middle}
.higer-product .hp-dot{display:inline-block;width:8px;height:8px;margin-inline-end:6px;border-radius:50%;background:var(--hp-ok)}
.higer-product .hp-dot.is-out{background:var(--hp-bad)}
.higer-product button.hp-pick{padding:7px 16px;border-radius:9999px;background:var(--hp-navy-900);color:var(--hp-gold-300);font-size:11px;font-weight:900;white-space:nowrap;transition:background .2s,color .2s}
.higer-product button.hp-pick:is(:hover,:focus){background:var(--hp-gold-500);color:var(--hp-navy-900)}
.higer-product button.hp-pick:disabled{cursor:not-allowed;opacity:.4;background:var(--hp-navy-900);color:var(--hp-gold-300)}
.higer-product .hp-mini-meter{display:inline-flex;gap:3px;margin-inline-start:8px;vertical-align:middle}
.higer-product .hp-mini-meter i{width:14px;height:5px;border-radius:9999px;background:var(--hp-line)}
.higer-product .hp-mini-meter i.is-on{background:var(--hp-gold-500)}
.higer-product .hp-table-note{margin-top:12px;font-size:12px;color:var(--hp-navy-600)}
.higer-product .hp-side{display:grid;gap:16px}
.higer-product .hp-navy-card{position:relative;overflow:hidden;border:1px solid var(--hp-navy-800);border-radius:24px;background:radial-gradient(600px 300px at 90% -10%,rgba(217,161,59,.16),transparent 60%),linear-gradient(160deg,#0b1a30 0%,#10243e 55%,#16304f 100%);color:var(--hp-cream);padding:22px;box-shadow:0 24px 50px rgba(7,15,29,.3)}
.higer-product .hp-navy-card::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:40px 40px;pointer-events:none}
.higer-product .hp-navy-card>*{position:relative}
.higer-product .hp-navy-head{display:flex;align-items:center;gap:8px;font-size:13px;font-weight:900;color:var(--hp-gold-300)}
.higer-product .hp-navy-value{margin-top:10px;font-size:22px;font-weight:900;color:#fff}
.higer-product .hp-navy-value small{font-size:12px;font-weight:700;color:rgba(250,247,239,.6)}
.higer-product .hp-firm-scale{display:grid;grid-auto-columns:minmax(0,1fr);grid-auto-flow:column;gap:6px;margin-top:16px}
.higer-product .hp-firm-scale div{text-align:center}
.higer-product .hp-firm-scale i{display:block;height:10px;border-radius:9999px;background:rgba(255,255,255,.12)}
.higer-product .hp-firm-scale .is-on i{background:linear-gradient(to left,#f3d98b,#c8892a)}
.higer-product .hp-firm-scale span{display:block;margin-top:8px;font-size:10px;font-weight:700;color:rgba(250,247,239,.55)}
.higer-product .hp-firm-scale .is-current span{font-weight:900;color:var(--hp-gold-300)}
.higer-product .hp-navy-note{margin-top:14px;font-size:12px;line-height:1.9;color:rgba(250,247,239,.65)}
.higer-product .hp-navy-card a.hp-btn-outline{margin-top:12px}
.higer-product .hp-layer-card{display:flex;align-items:center;gap:16px;padding:20px}
.higer-product .hp-layer-svg{width:110px;height:auto}
.higer-product .hp-layer-card small{display:block;font-size:11px;font-weight:800;color:var(--hp-navy-600)}
.higer-product .hp-layer-card b{display:block;margin-top:2px;font-size:16px;font-weight:900}
.higer-product .hp-layer-card p{margin-top:4px;font-size:12px;line-height:1.9;color:var(--hp-navy-700)}

/* ---------- معرفی و نوع هسته ---------- */
.higer-product .hp-about-grid{display:grid;gap:20px;align-items:stretch}
@media(min-width:1024px){.higer-product .hp-about-grid{grid-template-columns:minmax(0,1.3fr) minmax(0,1fr)}.higer-product .hp-about-grid.is-single{grid-template-columns:minmax(0,1fr)}}
.higer-product .hp-about-card{padding:24px}
@media(min-width:640px){.higer-product .hp-about-card{padding:32px}}
.higer-product .hp-prose{margin-top:14px;font-size:14px;line-height:2.1;color:var(--hp-navy-700)}
.higer-product .hp-prose :is(p,ul,ol){margin:0 0 12px}
.higer-product .hp-prose :is(ul,ol){padding-inline-start:20px;list-style:disc}
.higer-product .hp-prose img{margin-block:12px;border-radius:16px}
.higer-product .hp-prose a{color:var(--hp-gold-600);text-decoration:underline}
.higer-product .hp-core-card{display:flex;flex-direction:column;gap:6px}
.higer-product .hp-core-card .hp-core-svg{width:100%;max-width:340px;height:auto;margin:0 auto 10px}
.higer-product .hp-core-card small{font-size:11px;font-weight:800;color:var(--hp-gold-400)}
.higer-product .hp-core-card h3{font-size:22px;color:#fff}
.higer-product .hp-core-card p{font-size:13px;line-height:2;color:rgba(250,247,239,.75)}
.higer-product .hp-core-card a.hp-btn-outline{align-self:flex-start;margin-top:10px}

/* ---------- سؤالات و نظرات ---------- */
.higer-product details.hp-acc{margin-top:10px;overflow:hidden;border:1px solid var(--hp-line);border-radius:16px;background:#fffdf6}
.higer-product .hp-acc summary{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:15px 18px;font-size:14px;font-weight:800;color:var(--hp-navy-900);list-style:none;cursor:pointer}
.higer-product .hp-acc summary::-webkit-details-marker{display:none}
.higer-product .hp-acc summary::after{content:"+";display:grid;flex:none;place-items:center;width:28px;height:28px;border-radius:50%;background:var(--hp-paper);color:var(--hp-gold-600);font-weight:900;transition:transform .25s}
.higer-product .hp-acc[open] summary::after{transform:rotate(45deg);background:var(--hp-gold-500);color:var(--hp-navy-900)}
.higer-product .hp-acc-body{padding:0 18px 16px;font-size:13px;line-height:2.1;color:var(--hp-navy-700)}
.higer-product .hp-review-box{padding:20px}
@media(min-width:640px){.higer-product .hp-review-box{padding:28px}}
.higer-product .hp-review-box :is(h2,h3,.woocommerce-Reviews-title,.comment-reply-title){display:block;margin:0 0 12px;font-size:16px;font-weight:900;color:var(--hp-navy-900)}
.higer-product .hp-review-box .commentlist{display:grid;gap:12px;margin:0 0 20px;padding:0;list-style:none}
.higer-product .hp-review-box .commentlist li{margin:0;padding:16px;border:1px solid var(--hp-line);border-radius:16px;background:#fffdf6}
.higer-product .hp-review-box p{margin:0 0 12px;font-size:13px;line-height:2}
.higer-product .hp-review-box :is(.woocommerce-noreviews,.must-log-in){color:var(--hp-navy-600)}
.higer-product .hp-review-box a{color:var(--hp-gold-600);text-decoration:underline}
.higer-product .hp-review-box :is(input[type="text"],input[type="email"],textarea,select){width:100%;padding:12px 14px;border:1.5px solid var(--hp-line);border-radius:14px;background:#fff;font:inherit;color:var(--hp-navy-900)}
.higer-product .hp-review-box :is(input[type="submit"],button[type="submit"]){border:0;border-radius:9999px;padding:12px 24px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hp-navy-900);font:inherit;font-weight:900;cursor:pointer}

/* ---------- محصولات مرتبط ---------- */
.higer-product .hp-rel-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
@media(min-width:1024px){.higer-product .hp-rel-grid{grid-template-columns:repeat(4,minmax(0,1fr));gap:20px}}
.higer-product .hp-rel-card{display:flex;flex-direction:column;overflow:hidden;color:var(--hp-navy-900);transition:transform .3s,box-shadow .3s,border-color .3s}
.higer-product .hp-rel-card:hover{transform:translateY(-5px);border-color:rgba(217,161,59,.55);box-shadow:0 22px 48px rgba(16,36,62,.16);color:var(--hp-navy-900)}
.higer-product .hp-rel-media{display:block;aspect-ratio:4/3;overflow:hidden;background:var(--hp-navy-900)}
.higer-product .hp-rel-media img{width:100%;height:100%;object-fit:cover}
.higer-product .hp-rel-media .hp-core-svg{width:100%;height:100%;padding:18px}
.higer-product .hp-rel-body{display:flex;flex-direction:column;gap:3px;padding:14px 16px 16px}
.higer-product .hp-rel-body small{font-size:10px;font-weight:800;color:var(--hp-gold-600)}
.higer-product .hp-rel-body b{font-size:16px;font-weight:900}
.higer-product .hp-rel-price{margin-top:6px;font-size:12px;font-weight:900;color:var(--hp-navy-900)}

/* ---------- نوار تماس و نوار خرید موبایل ---------- */
.higer-product .hp-cta{padding-block:48px;background:radial-gradient(1100px 520px at 85% -10%,rgba(217,161,59,.16),transparent 60%),linear-gradient(160deg,#0b1a30 0%,#10243e 45%,#16304f 100%);color:var(--hp-cream)}
@media(max-width:1023px){.higer-product .hp-cta{padding-bottom:120px}}
.higer-product .hp-cta-inner{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:20px}
.higer-product .hp-cta h2{margin-top:12px;font-size:22px;color:#fff}
@media(min-width:640px){.higer-product .hp-cta h2{font-size:28px}}
.higer-product .hp-cta p{display:flex;align-items:flex-start;gap:6px;margin-top:8px;font-size:12px;line-height:2;color:rgba(250,247,239,.72)}
.higer-product .hp-cta p .hp-i{margin-top:5px;color:var(--hp-gold-400)}
.higer-product .hp-sticky{position:fixed;right:12px;left:12px;bottom:12px;z-index:9990;display:flex;align-items:center;gap:12px;padding:10px;padding-inline-start:16px;border:1px solid rgba(217,161,59,.3);border-radius:20px;background:rgba(16,36,62,.96);color:var(--hp-cream);box-shadow:0 18px 40px rgba(7,15,29,.45);backdrop-filter:blur(10px);transform:translateY(calc(100% + 24px));transition:transform .3s ease}
.higer-product .hp-sticky.is-visible{transform:none}
@media(min-width:1024px){.higer-product .hp-sticky{display:none}}
.higer-product .hp-sticky-info{flex:1;min-width:0}
.higer-product .hp-sticky-info small{display:block;font-size:10px;font-weight:700;color:rgba(250,247,239,.6)}
.higer-product .hp-sticky-info b{display:block;overflow:hidden;font-size:14px;font-weight:900;color:var(--hp-gold-300);white-space:nowrap;text-overflow:ellipsis}
.higer-product .hp-sticky button.hp-btn-gold{padding:12px 16px;font-size:12px}

/* ---------- ساختار و مواد ---------- */
.higer-product .hp-build{margin-top:40px;scroll-margin-top:calc(var(--hp-sticky-top,var(--wp-admin--admin-bar--height,0px)) + var(--hp-tabs-h,58px) + 12px)}
.higer-product .hp-build .hp-head{margin-bottom:18px}
.higer-product .hp-h3{margin-top:10px;font-size:20px;line-height:1.6;color:var(--hp-navy-900)}
@media(min-width:640px){.higer-product .hp-h3{font-size:24px}}
.higer-product .hp-detail-grid{display:grid;gap:16px}
@media(min-width:768px){.higer-product .hp-detail-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(min-width:1100px){.higer-product .hp-detail-grid{grid-template-columns:repeat(3,minmax(0,1fr))}}
.higer-product .hp-detail-card{display:flex;flex-direction:column;gap:6px;padding:18px}
.higer-product .hp-detail-art{margin-bottom:8px;border:1px solid rgba(243,217,139,.14);border-radius:16px;background:rgba(7,15,29,.35);padding:10px}
.higer-product .hp-detail-svg{display:block;width:100%;height:auto}
.higer-product .hp-detail-card small{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:800;color:var(--hp-gold-400)}
.higer-product .hp-detail-card h4{font-size:18px;font-weight:900;color:#fff}
.higer-product .hp-detail-card p{font-size:13px;line-height:2;color:rgba(250,247,239,.75)}

/* ---------- ویژگی‌های کلیدی زیر تصویر ---------- */
.higer-product .hp-keys{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-top:14px}
.higer-product .hp-key{display:flex;align-items:flex-start;gap:10px;min-width:0;padding:12px;border:1px solid var(--hp-line);border-radius:16px;background:#fff;box-shadow:0 6px 18px rgba(16,36,62,.05)}
.higer-product .hp-key>i{display:grid;flex:none;place-items:center;width:36px;height:36px;border-radius:12px;background:var(--hp-navy-900);color:var(--hp-gold-400);font-style:normal}
.higer-product .hp-key>span{flex:1;min-width:0}
.higer-product .hp-key small{display:block;font-size:10px;font-weight:800;color:var(--hp-navy-600)}
.higer-product .hp-key b{display:block;font-size:13px;font-weight:900;line-height:1.7;color:var(--hp-navy-900)}
.higer-product .hp-key em{font-size:11px;font-style:normal;font-weight:700;color:var(--hp-navy-600)}
.higer-product .hp-key .hp-meter{margin-top:6px}

/* ---------- دکمه‌های افزودن به مقایسه ---------- */
.higer-product :is(.hp-cmp-on,.hp-cmp-off){display:inline-flex;align-items:center;gap:6px}
.higer-product [data-hp-cmp-toggle] .hp-cmp-on{display:none}
.higer-product [data-hp-cmp-toggle][aria-pressed="true"] .hp-cmp-on{display:inline-flex}
.higer-product [data-hp-cmp-toggle][aria-pressed="true"] .hp-cmp-off{display:none}

.higer-product button.hp-link-btn[aria-pressed="true"]{border-color:var(--hp-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);color:var(--hp-navy-900)}
.higer-product .hp-tab-count{display:inline-grid;place-items:center;min-width:18px;height:18px;margin-inline-start:4px;padding:0 5px;border-radius:9999px;background:var(--hp-gold-500);color:var(--hp-navy-900);font-size:10px;font-weight:900;line-height:1}

/* ---------- ابزارهای مقایسه ---------- */
.higer-product .hp-cmp-bar{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:10px}
.higer-product .hp-seg{display:inline-flex;flex-wrap:wrap;gap:4px;padding:4px;border:1px solid var(--hp-line);border-radius:9999px;background:#fff}
.higer-product .hp-seg button{padding:8px 14px;border-radius:9999px;font-size:12px;font-weight:800;color:var(--hp-navy-700)}
.higer-product .hp-seg button:is(:hover,:focus){background:var(--hp-paper);color:var(--hp-navy-900)}
.higer-product .hp-seg button[aria-pressed="true"]{background:var(--hp-navy-900);color:var(--hp-gold-300)}
.higer-product .hp-seg button:disabled{cursor:not-allowed;opacity:.45;background:transparent}
.higer-product .hp-cmp-size{display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:800;color:var(--hp-navy-700)}
.higer-product .hp-cmp-size select{min-width:150px;height:40px;margin:0;padding:0 12px;border:1.5px solid var(--hp-line);border-radius:9999px;background:#fff;font:inherit;font-size:12px;font-weight:800;color:var(--hp-navy-900)}
.higer-product button.hp-cmp-clear{margin-inline-start:auto;padding:8px 14px;border:1px solid var(--hp-line);border-radius:9999px;font-size:12px;font-weight:800;color:var(--hp-bad)}
.higer-product button.hp-cmp-clear:is(:hover,:focus){border-color:var(--hp-bad);background:#fff;color:var(--hp-bad)}
.higer-product .hp-cmp-help{margin-bottom:14px;font-size:12px;font-weight:700;line-height:1.9;color:var(--hp-navy-600)}
.higer-product .hp-cmp-help:empty{display:none}
.higer-product .hp-compare-table th[scope="row"]{position:sticky;right:0;z-index:1;background:#fff;font-weight:900;white-space:nowrap;box-shadow:-1px 0 0 var(--hp-line)}
.higer-product .hp-compare-table thead th:first-child{position:sticky;right:0;z-index:2}
.higer-product .hp-compare-table tr.is-current :is(th,td){background:#fdf6e3}
.higer-product .hp-compare-table tr.is-current th[scope="row"]{box-shadow:inset -4px 0 0 var(--hp-gold-500),-1px 0 0 var(--hp-line)}
@media(max-width:767px){
  .higer-product .hp-here{display:none}
  .higer-product .hp-compare-table :is(th,td){padding:11px 10px;font-size:12px}
}
.higer-product .hp-compare-table td.hp-cmp-price{font-weight:900;white-space:nowrap}
.higer-product .hp-out{display:inline-flex;margin-inline-start:6px;padding:2px 8px;border-radius:9999px;background:#fee2e2;color:var(--hp-bad);font-size:10px;font-weight:900}
.higer-product button.hp-cmp-row-btn{display:inline-flex;align-items:center;padding:7px 12px;border:1.5px solid var(--hp-line);border-radius:9999px;background:#fff;font-size:11px;font-weight:900;color:var(--hp-navy-800);white-space:nowrap;transition:border-color .2s,background .2s}
.higer-product button.hp-cmp-row-btn:is(:hover,:focus){border-color:var(--hp-gold-500);background:#fff;color:var(--hp-navy-900)}
.higer-product button.hp-cmp-row-btn[aria-pressed="true"]{border-color:var(--hp-gold-500);background:#fdf3d8;color:var(--hp-navy-900)}
.higer-product details.hp-cmp-more{margin-top:14px;overflow:hidden;border:1px solid var(--hp-line);border-radius:16px;background:#fff}
.higer-product .hp-cmp-more summary{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:13px 16px;font-size:13px;font-weight:800;color:var(--hp-navy-900);list-style:none;cursor:pointer}
.higer-product .hp-cmp-more summary::-webkit-details-marker{display:none}
.higer-product .hp-cmp-more summary::after{content:"+";display:grid;flex:none;place-items:center;width:26px;height:26px;border-radius:50%;background:var(--hp-paper);color:var(--hp-gold-600);font-weight:900;transition:transform .25s}
.higer-product .hp-cmp-more[open] summary::after{transform:rotate(45deg);background:var(--hp-gold-500);color:var(--hp-navy-900)}
.higer-product .hp-cmp-chips{display:flex;flex-wrap:wrap;gap:8px;padding:0 16px 16px}
.higer-product button.hp-cmp-chip{display:inline-flex;flex-direction:column;align-items:flex-start;padding:8px 12px;border:1.5px solid var(--hp-line);border-radius:14px;background:#fffdf6;text-align:right;transition:border-color .2s}
.higer-product button.hp-cmp-chip:is(:hover,:focus){border-color:var(--hp-gold-500);background:#fffdf6;color:var(--hp-navy-900)}
.higer-product button.hp-cmp-chip[aria-pressed="true"]{border-color:var(--hp-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);box-shadow:inset 0 0 0 1px rgba(217,161,59,.45)}
.higer-product button.hp-cmp-chip b{font-size:12px;font-weight:900}
.higer-product button.hp-cmp-chip small{font-size:10px;font-weight:700;color:var(--hp-navy-600)}

/* ---------- کارت محصولات مرتبط ---------- */
.higer-product a.hp-rel-link{display:flex;flex:1;flex-direction:column;color:var(--hp-navy-900)}
.higer-product a.hp-rel-link:hover{color:var(--hp-navy-900)}
.higer-product .hp-rel-keys{display:flex;flex-wrap:wrap;gap:4px;margin-top:6px}
.higer-product .hp-rel-keys>span{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:9999px;background:var(--hp-paper);font-size:10px;font-weight:800;line-height:1.8;color:var(--hp-navy-700)}
.higer-product .hp-rel-keys .hp-i{color:var(--hp-gold-600)}
.higer-product .hp-rel-keys .hp-mini-meter{margin-inline-start:2px}
.higer-product .hp-rel-keys .hp-mini-meter i{width:8px}
.higer-product button.hp-rel-cmp{display:flex;align-items:center;justify-content:center;margin:0 12px 12px;padding:9px;border:1px solid var(--hp-line);border-radius:12px;background:var(--hp-cream);font-size:11px;font-weight:800;color:var(--hp-navy-800);transition:border-color .2s,background .2s}
.higer-product button.hp-rel-cmp:is(:hover,:focus){border-color:var(--hp-gold-500);background:#fff;color:var(--hp-navy-900)}
.higer-product button.hp-rel-cmp[aria-pressed="true"]{border-color:var(--hp-gold-500);background:#fdf3d8;color:var(--hp-navy-900)}

@media(prefers-reduced-motion:reduce){.higer-product *,.higer-product *::before,.higer-product *::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}}
</style>
<script id="higer-product-js">
/* ============ هیگر — اسکریپت صفحه محصول (خوانا و قابل ویرایش) ============ */
(function () {
  'use strict';

  var FONTS = [
    'https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css',
    'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css'
  ];

  var FA_DIGITS = '۰۱۲۳۴۵۶۷۸۹';
  function toFa(value) { return String(value).replace(/[0-9]/g, function (d) { return FA_DIGITS[+d]; }); }

  function addFonts() {
    var head = document.head || document.documentElement;
    FONTS.forEach(function (href) {
      if (document.querySelector('link[href="' + href + '"]')) return;
      var link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = href;
      head.appendChild(link);
    });
  }

  function mount(root) {
    if (root.getAttribute('data-hp-mounted')) return;
    var source = root.querySelector('script[data-hp-data]');
    var data;
    try { data = JSON.parse(source ? source.textContent : '{}'); } catch (error) { return; }
    root.setAttribute('data-hp-mounted', '1');

    function one(selector) { return root.querySelector(selector); }
    function all(selector) { return Array.prototype.slice.call(root.querySelectorAll(selector)); }

    var options = data.options || {};
    var keys = Object.keys(options);
    var variations = data.variations || [];
    var prompts = data.prompts || {};
    var visibleKeys = Object.keys(prompts);
    var form = one('[data-hp-form]');
    var addButton = one('[data-hp-add]');
    var hint = one('[data-hp-hint]');
    var qty = one('[data-hp-qty-input]');
    var state = {};

    function labelOf(key, value) {
      var list = options[key] || [];
      for (var i = 0; i < list.length; i++) if (list[i].value === value) return list[i].label;
      return value;
    }
    function hasValue(key, value) {
      return (options[key] || []).some(function (item) { return item.value === value; });
    }
    function own(variation, key) {
      return variation.attrs && variation.attrs[key] !== undefined ? variation.attrs[key] : '';
    }
    /* یک متغیر با انتخاب‌ها سازگار است اگر مقدار هر ویژگی یا «هرکدام» (خالی) باشد یا برابر انتخاب */
    function fits(variation, selection, skip) {
      return keys.every(function (key) {
        if (key === skip || !selection[key]) return true;
        var value = own(variation, key);
        return value === '' || value === selection[key];
      });
    }
    function complete() {
      return keys.every(function (key) { return !!state[key]; });
    }
    function current() {
      if (!data.variable || !complete()) return null;
      for (var i = 0; i < variations.length; i++) if (fits(variations[i], state)) return variations[i];
      return null;
    }
    function available(key, value) {
      var selection = {};
      keys.forEach(function (k) { selection[k] = state[k]; });
      selection[key] = value;
      return variations.some(function (variation) {
        var v = own(variation, key);
        return variation.inStock && (v === '' || v === value) && fits(variation, selection, key);
      });
    }

    /* انتخاب‌های اولیه: پیش‌فرض ووکامرس، سپس پارامتر آدرس مثل ?attribute_pa_size=160x200 */
    Object.keys(data.defaults || {}).forEach(function (key) {
      if (hasValue(key, data.defaults[key])) state[key] = data.defaults[key];
    });
    try {
      var params = new URLSearchParams(window.location.search);
      keys.forEach(function (key) {
        var value = params.get('attribute_' + key);
        if (value && hasValue(key, value)) state[key] = value;
      });
    } catch (error) { /* مرورگرهای قدیمی */ }

    function clampQty() {
      if (!qty) return;
      var min = parseInt(qty.min, 10) || 1;
      var max = parseInt(qty.max, 10) || 0;
      var value = parseInt(qty.value, 10) || min;
      if (value < min) value = min;
      if (max && value > max) value = max;
      qty.value = value;
    }

    function hintText(variation) {
      if (!data.variable) return data.purchasable ? '' : 'این محصول در حال حاضر قابل خرید نیست.';
      var missing = visibleKeys.filter(function (key) { return !state[key]; }).map(function (key) { return prompts[key]; });
      if (missing.length) return 'برای افزودن به سبد، ابتدا ' + missing.join(' و ') + ' را انتخاب کنید.';
      if (!variation) return 'این ترکیب در فروشگاه موجود نیست.';
      if (!variation.inStock) return 'این گزینه در حال حاضر موجود نیست.';
      return '';
    }

    function update() {
      var variation = current();
      var ready = data.variable ? !!(variation && variation.inStock && variation.purchasable) : !!data.purchasable;

      all('[data-hp-opt]').forEach(function (button) {
        var key = button.getAttribute('data-hp-opt');
        var value = button.getAttribute('data-value');
        var on = state[key] === value;
        button.setAttribute('aria-pressed', on ? 'true' : 'false');
        button.disabled = !on && !available(key, value);
      });
      visibleKeys.forEach(function (key) {
        var out = one('[data-hp-selected="' + key + '"]');
        if (out) out.textContent = state[key] ? labelOf(key, state[key]) : 'انتخاب نشده';
      });
      all('[data-hp-attr-input]').forEach(function (input) {
        input.value = state[input.getAttribute('data-hp-attr-input')] || '';
      });
      var variationInput = one('[data-hp-variation]');
      if (variationInput) variationInput.value = variation ? variation.id : '';

      var price = one('[data-hp-price]');
      var regular = one('[data-hp-regular]');
      var priceLabel = one('[data-hp-price-label]');
      var stock = one('[data-hp-stock]');
      var sizeLabel = data.sizeKey && state[data.sizeKey] ? labelOf(data.sizeKey, state[data.sizeKey]) : '';
      if (data.variable) {
        if (price) price.textContent = variation ? variation.priceText : data.rangeText;
        if (regular) {
          regular.textContent = variation && variation.regularText ? variation.regularText : '';
          regular.hidden = !(variation && variation.regularText);
        }
        if (priceLabel) priceLabel.textContent = variation ? (sizeLabel ? 'قیمت سایز ' + sizeLabel : 'قیمت گزینه انتخاب‌شده') : data.rangeLabel;
        if (stock) {
          var inStock = variation ? variation.inStock : data.inStock;
          stock.textContent = inStock ? 'موجود' : 'ناموجود';
          stock.classList.toggle('is-out', !inStock);
        }
      }
      if (addButton) addButton.disabled = !ready;
      if (hint) hint.textContent = hintText(variation);
      if (qty) {
        var max = variation && variation.maxQty > 0 ? variation.maxQty : data.maxQty;
        if (max > 0) qty.max = max; else qty.removeAttribute('max');
        clampQty();
      }
      all('[data-hp-row]').forEach(function (row) {
        row.classList.toggle('is-selected', !!data.sizeKey && row.getAttribute('data-hp-row') === state[data.sizeKey]);
      });

      var stickyLabel = one('[data-hp-sticky-label]');
      var stickyPrice = one('[data-hp-sticky-price]');
      var stickyText = one('[data-hp-sticky-text]');
      if (stickyLabel) stickyLabel.textContent = variation && sizeLabel ? 'سایز ' + sizeLabel : (visibleKeys.length ? prompts[visibleKeys[0]] + ' انتخاب نشده' : data.name);
      if (stickyPrice) stickyPrice.textContent = variation ? variation.priceText : data.rangeText;
      if (stickyText) stickyText.textContent = ready ? 'افزودن به سبد' : (visibleKeys.length ? 'انتخاب ' + prompts[visibleKeys[0]] : 'تماس با فروشگاه');

      /* قیمت جدول مقایسه همراه سایز انتخاب‌شده عوض می‌شود، مگر کاربر خودش سایز دیگری انتخاب کرده باشد */
      if (cmpSelect && !cmpSizeManual && data.sizeKey) {
        var wanted = state[data.sizeKey] || '';
        if (wanted && !Array.prototype.some.call(cmpSelect.options, function (o) { return o.value === wanted; })) wanted = '';
        if (cmpSelect.value !== wanted) { cmpSelect.value = wanted; setComparePrices(wanted); }
      }
    }

    function flashHint() {
      if (!hint) return;
      hint.classList.remove('is-flash');
      void hint.offsetWidth;
      hint.classList.add('is-flash');
    }
    function scrollToBuy(focusKey) {
      var buy = one('[data-hp-buy]');
      if (buy) buy.scrollIntoView({ behavior: 'smooth', block: 'start' });
      if (!focusKey) return;
      var pressed = one('[data-hp-opt="' + focusKey + '"][aria-pressed="true"]');
      if (pressed) window.setTimeout(function () { pressed.focus({ preventScroll: true }); }, 400);
    }
    function stickyAction() {
      if (addButton && !addButton.disabled && form) {
        if (form.requestSubmit) form.requestSubmit(addButton); else addButton.click();
        return;
      }
      if (!data.variable && !data.purchasable) {
        var tel = one('.hp-cta a[href^="tel:"]');
        if (tel) window.location.href = tel.getAttribute('href');
        return;
      }
      scrollToBuy();
      flashHint();
    }

    /* گالری */
    var slides = all('[data-hp-slide]');
    var thumbs = all('[data-hp-thumb]');
    var slideIndex = 0;
    function go(index) {
      if (!slides.length) return;
      slideIndex = (index + slides.length) % slides.length;
      slides.forEach(function (slide, n) { slide.classList.toggle('is-active', n === slideIndex); });
      thumbs.forEach(function (thumb) {
        thumb.setAttribute('aria-current', parseInt(thumb.getAttribute('data-hp-thumb'), 10) === slideIndex ? 'true' : 'false');
      });
    }
    var stage = one('[data-hp-stage]');
    if (stage && slides.length > 1) {
      stage.addEventListener('keydown', function (event) {
        if (event.key === 'ArrowLeft') { event.preventDefault(); go(slideIndex + 1); }
        if (event.key === 'ArrowRight') { event.preventDefault(); go(slideIndex - 1); }
      });
      var startX = null;
      stage.addEventListener('pointerdown', function (event) { startX = event.clientX; });
      stage.addEventListener('pointerup', function (event) {
        if (startX === null) return;
        var dx = event.clientX - startX;
        startX = null;
        if (Math.abs(dx) > 40) go(slideIndex + (dx > 0 ? 1 : -1));
      });
    }

    root.addEventListener('click', function (event) {
      var target = event.target.closest ? event.target.closest('button, a') : null;
      if (!target || !root.contains(target)) return;
      if (target.hasAttribute('data-hp-cmp-toggle')) { toggleCompare(parseInt(target.getAttribute('data-hp-cmp-toggle'), 10)); return; }
      if (target.hasAttribute('data-hp-cmp-mode')) { cmpMode = target.getAttribute('data-hp-cmp-mode'); renderCompare(); return; }
      if (target.hasAttribute('data-hp-cmp-clear')) { basket = []; writeBasket(); cmpMode = ''; renderCompare(); return; }
      if (target.hasAttribute('data-hp-opt')) {
        state[target.getAttribute('data-hp-opt')] = target.getAttribute('data-value');
        update();
        return;
      }
      if (target.hasAttribute('data-hp-pick')) {
        var key = target.getAttribute('data-hp-pick');
        state[key] = target.getAttribute('data-value');
        update();
        scrollToBuy(key);
        return;
      }
      if (target.hasAttribute('data-hp-qty') && qty) {
        qty.value = (parseInt(qty.value, 10) || 1) + parseInt(target.getAttribute('data-hp-qty'), 10);
        clampQty();
        return;
      }
      if (target.hasAttribute('data-hp-sticky-add')) { stickyAction(); return; }
      if (target.hasAttribute('data-hp-step')) { go(slideIndex + parseInt(target.getAttribute('data-hp-step'), 10)); return; }
      if (target.hasAttribute('data-hp-thumb')) { go(parseInt(target.getAttribute('data-hp-thumb'), 10)); return; }
      var href = target.getAttribute('href') || '';
      if (target.tagName === 'A' && href.charAt(0) === '#' && href.length > 1) {
        var section = document.getElementById(href.slice(1));
        if (section && root.contains(section)) {
          event.preventDefault();
          section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
    if (qty) qty.addEventListener('change', clampQty);
    if (form) {
      form.addEventListener('submit', function (event) {
        if (addButton && addButton.disabled) {
          event.preventDefault();
          scrollToBuy();
          flashHint();
        }
      });
    }

    /* ارتفاع هدر چسبنده سایت را اندازه می‌گیرد تا منوی بخش‌ها زیر هدر نرود */
    var tabsBar = one('[data-hp-tabs]');
    var lastStickyTop = -1;
    var stickyTicking = false;
    function syncStickyOffset() {
      stickyTicking = false;
      var adminH = 0;
      var adminBar = document.getElementById('wpadminbar');
      if (adminBar) {
        var ar = adminBar.getBoundingClientRect();
        if (ar.height > 0 && ar.bottom > 0 && window.getComputedStyle(adminBar).position === 'fixed') {
          adminH = ar.bottom;
        }
      }
      var top = adminH;
      if (data.stickyOffset > 0) {
        top = data.stickyOffset + adminH;
      } else {
        var minW = window.innerWidth * 0.5;
        var nodes = document.querySelectorAll('header, [role="banner"], [data-elementor-type="header"], .elementor-location-header, .elementor-sticky, .elementor-sticky--active, [class*="sticky"], [class*="fixed"]');
        for (var i = 0; i < nodes.length; i++) {
          var el = nodes[i];
          if (root.contains(el) || el.id === 'wpadminbar' || el.classList.contains('elementor-sticky__spacer')) continue;
          var cs = window.getComputedStyle(el);
          if (cs.display === 'none' || cs.visibility === 'hidden' || parseFloat(cs.opacity) === 0) continue;
          var isFixedOrSticky = cs.position === 'fixed' || cs.position === 'sticky';
          var isElSticky = el.classList.contains('elementor-sticky') || el.classList.contains('elementor-sticky--active');
          if (!isFixedOrSticky && !isElSticky) continue;
          var r = el.getBoundingClientRect();
          if (r.height < 24 || r.height > 220 || r.width < minW) continue;
          if (isFixedOrSticky && r.top >= -4 && r.top <= 90 && r.bottom > top) {
            top = r.bottom;
          } else if (isElSticky && r.top >= -4 && r.top <= 90) {
            top = Math.max(top, r.height + adminH);
          }
        }
      }
      var px = Math.max(0, Math.floor(top));
      if (px !== lastStickyTop) {
        lastStickyTop = px;
        root.style.setProperty('--hp-sticky-top', px + 'px');
      }
      if (tabsBar) {
        var th = Math.round(tabsBar.getBoundingClientRect().height);
        if (th > 0) root.style.setProperty('--hp-tabs-h', th + 'px');
      }
    }
    function scheduleStickySync() {
      if (stickyTicking) return;
      stickyTicking = true;
      (window.requestAnimationFrame || function (fn) { return window.setTimeout(fn, 16); })(syncStickyOffset);
    }
    syncStickyOffset();
    window.addEventListener('scroll', scheduleStickySync, { passive: true });
    window.addEventListener('resize', scheduleStickySync);
    window.addEventListener('load', syncStickyOffset);
    window.setTimeout(syncStickyOffset, 500);

    /* منوی بخش‌ها: بخش در حال مشاهده را مشخص می‌کند */
    var tabs = all('[data-hp-tabs] a');
    if ('IntersectionObserver' in window && tabs.length) {
      var sectionObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          tabs.forEach(function (tab) {
            var on = tab.getAttribute('href') === '#' + entry.target.id;
            tab.classList.toggle('is-active', on);
            if (on) tab.setAttribute('aria-current', 'true'); else tab.removeAttribute('aria-current');
          });
        });
      }, { rootMargin: '-35% 0px -55% 0px' });
      all('[data-hp-section]').forEach(function (section) { sectionObserver.observe(section); });
    }

    /* نوار خرید موبایل وقتی فرم خرید دیده نمی‌شود */
    var sticky = one('[data-hp-sticky]');
    if (sticky && form && 'IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        sticky.classList.toggle('is-visible', !entries[0].isIntersecting);
      }).observe(form);
    }

    /* تمام‌عرض کردن، حتی داخل ستون محدود المنتور */
    if (root.getAttribute('data-hp-fw') === 'yes') {
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
      window.setTimeout(fit, 600);
    }

    /* ---------- مقایسه ----------
       فهرست مقایسه در localStorage ذخیره می‌شود تا در صفحه محصولات دیگر هم بماند.
       اگر مدلی انتخاب شده باشد، جدول فقط همان مدل‌ها را کنار محصول همین صفحه نشان می‌دهد. */
    var cmp = data.compare || null;
    var CMP_KEY = 'higer-compare';
    var cmpMode = '';
    var cmpSizeManual = false;
    var cmpSelect = one('[data-hp-cmp-size]');
    var basket = readBasket();

    function readBasket() {
      try {
        var list = JSON.parse(window.localStorage.getItem(CMP_KEY) || '[]');
        return Array.isArray(list) ? list.map(Number).filter(function (n) { return n > 0; }) : [];
      } catch (error) { return []; }
    }
    function writeBasket() {
      try { window.localStorage.setItem(CMP_KEY, JSON.stringify(basket)); } catch (error) { /* مرورگر اجازه ذخیره نمی‌دهد */ }
    }
    function picked() { return cmp ? basket.filter(function (id) { return cmp.ids.indexOf(id) > -1; }) : []; }
    function others() { return picked().filter(function (id) { return id !== cmp.current; }); }
    function cmpView() { return others().length ? (cmpMode || 'selected') : 'all'; }

    function renderCompare() {
      all('[data-hp-cmp-toggle]').forEach(function (button) {
        var on = basket.indexOf(parseInt(button.getAttribute('data-hp-cmp-toggle'), 10)) > -1;
        button.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
      if (!cmp) return;
      var view = cmpView();
      var chosen = picked();
      var extra = others().length;
      all('[data-hp-cmp-row]').forEach(function (row) {
        var id = parseInt(row.getAttribute('data-hp-cmp-row'), 10);
        row.hidden = view === 'all' ? cmp.defaults.indexOf(id) < 0 : !(id === cmp.current || chosen.indexOf(id) > -1);
      });
      all('[data-hp-cmp-mode]').forEach(function (button) {
        var mode = button.getAttribute('data-hp-cmp-mode');
        button.setAttribute('aria-pressed', mode === view ? 'true' : 'false');
        if (mode === 'selected') button.disabled = !extra;
      });
      var count = one('[data-hp-cmp-count]');
      if (count) count.textContent = '(' + toFa(chosen.length) + ')';
      var badge = one('[data-hp-cmp-badge]');
      if (badge) { badge.textContent = toFa(chosen.length); badge.hidden = !chosen.length; }
      var clear = one('[data-hp-cmp-clear]');
      if (clear) clear.hidden = !chosen.length;
      var help = one('[data-hp-cmp-help]');
      if (help) {
        help.textContent = view === 'selected'
          ? 'مدل‌های انتخاب‌شده در کنار همین مدل نمایش داده می‌شوند.'
          : (extra ? toFa(extra) + ' مدل انتخاب کرده‌اید؛ برای دیدن فقط همان‌ها «انتخاب‌شده‌ها» را بزنید.' : 'برای مقایسه مدل‌های دلخواه، روی «افزودن» کنار هر مدل بزنید.');
      }
    }
    function toggleCompare(id) {
      if (!id) return;
      var before = others().length;
      var at = basket.indexOf(id);
      if (at > -1) basket.splice(at, 1); else basket.push(id);
      writeBasket();
      if ((before === 0) !== (others().length === 0)) cmpMode = '';
      renderCompare();
    }
    function setComparePrices(size) {
      if (!cmp) return;
      all('[data-hp-cmp-price]').forEach(function (cell) {
        var id = cell.getAttribute('data-hp-cmp-price');
        var list = cmp.prices[id];
        cell.textContent = size ? (list && list[size] ? list[size] : '—') : (cmp.range[id] || '—');
      });
      var head = one('[data-hp-cmp-price-head]');
      if (head) head.textContent = size ? 'قیمت سایز ' + (cmp.sizes[size] || size) : 'محدوده قیمت';
    }
    if (cmpSelect) {
      cmpSelect.addEventListener('change', function () { cmpSizeManual = true; setComparePrices(cmpSelect.value); });
    }
    window.addEventListener('storage', function (event) {
      if (event.key === CMP_KEY) { basket = readBasket(); cmpMode = ''; renderCompare(); }
    });

    renderCompare();
    update();
  }

  function init() {
    addFonts();
    Array.prototype.forEach.call(document.querySelectorAll('.higer-product'), mount);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
</script>
<?php
		return (string) ob_get_clean();
	}
}

if ( ! function_exists( 'higer_product_render' ) ) {
	/**
	 * خروجی کامل صفحه محصول.
	 *
	 * @param array|string $atts ویژگی‌های شورت‌کد.
	 * @return string
	 */
	function higer_product_render( $atts = array() ) {
		static $depth = 0, $seen = array(), $schema = array();
		if ( $depth > 0 || ! function_exists( 'wc_get_product' ) ) {
			return '';
		}
		$atts       = shortcode_atts( array( 'id' => 0, 'fullwidth' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_product' );
		$product_id = absint( $atts['id'] );
		if ( ! $product_id ) {
			global $product;
			$product_id = ( is_object( $product ) && method_exists( $product, 'get_id' ) ) ? (int) $product->get_id() : (int) get_the_ID();
		}
		$item = $product_id ? wc_get_product( $product_id ) : null;
		if ( ! $item ) {
			return '';
		}
		$depth++;
		$seen[ $product_id ] = isset( $seen[ $product_id ] ) ? $seen[ $product_id ] + 1 : 1;

		$cfg   = higer_product_config();
		$d     = higer_product_collect( $item, $cfg );
		$cmp   = higer_product_compare_pool( $item, $d, $cfg );
		$rel   = higer_product_related_items( $item, $cfg );
		$store = $cfg['store'];
		$fa    = 'higer_product_fa';
		$uid   = 'hp-' . $product_id . ( $seen[ $product_id ] > 1 ? '-' . $seen[ $product_id ] : '' );

		/* پیام‌های ووکامرس (مثل «به سبد خرید افزوده شد») */
		$wc      = function_exists( 'WC' ) ? WC() : null;
		$notices = ( $wc && ! empty( $wc->session ) && function_exists( 'wc_print_notices' ) ) ? (string) wc_print_notices( true ) : '';

		/* اسکیمای محصول ووکامرس (اگر افزونه سئو آن را نمی‌سازد) */
		if ( ! empty( $cfg['structured_data'] ) && $wc && ! empty( $wc->structured_data ) && empty( $schema[ $product_id ] ) && method_exists( $wc->structured_data, 'generate_product_data' ) ) {
			$schema[ $product_id ] = true;
			$wc->structured_data->generate_product_data( $item );
		}

		$core      = $d['core'];
		$core_key  = $core ? $core['key'] : 'generic';
		$cat_term  = $d['category'] ? $d['category']['term'] : null;
		$cat_url   = higer_product_term_url( $cat_term );
		$core_url  = $core ? higer_product_term_url( $core['term'] ) : '';
		$size_key  = sanitize_title( $cfg['attributes']['size'] );
		$size_opt  = isset( $d['options'][ $size_key ] ) ? $d['options'][ $size_key ] : null;
		$visible   = array();
		$defaults  = $d['defaults'];
		$prompts   = array();
		foreach ( $d['options'] as $key => $option ) {
			if ( count( $option['values'] ) > 1 ) {
				$visible[ $key ] = $option;
				$prompts[ $key ] = $option['is_size'] ? 'سایز' : $option['label'];
			} elseif ( $option['values'] ) {
				$only             = array_keys( $option['values'] );
				$defaults[ $key ] = (string) $only[0];
			}
		}
		$size_texts = array();
		if ( $size_opt ) {
			foreach ( $size_opt['values'] as $value => $label ) {
				$size_texts[] = higer_product_size_text( $value, $label );
			}
		}
		$can_buy      = $d['purchasable'] && $d['in_stock'];
		$hint         = $d['variable'] ? ( $prompts ? 'برای افزودن به سبد، ابتدا ' . implode( ' و ', $prompts ) . ' را انتخاب کنید.' : '' ) : ( $can_buy ? '' : 'این محصول در حال حاضر قابل خرید نیست.' );
		$show_reviews = ! empty( $cfg['show_reviews'] ) && function_exists( 'comments_template' ) && ( comments_open( $product_id ) || $d['reviews'] > 0 ) && (int) get_queried_object_id() === (int) $product_id;
		$description  = '' !== $d['description'] ? wp_kses_post( wpautop( do_shortcode( $d['description'] ) ) ) : '';
		$faqs         = (array) $cfg['faqs'];
		if ( $size_texts ) {
			array_unshift( $faqs, array( 'q' => 'این مدل در چه سایزهایی عرضه می‌شود؟', 'a' => 'در ' . $fa( count( $size_texts ) ) . ' سایز: ' . implode( '، ', $size_texts ) . '.' ) );
		}
		$tabs = array( 'specs' => 'مشخصات' );
		if ( $d['details'] ) {
			$tabs['build'] = 'ساختار و مواد';
		}
		if ( $size_opt ) {
			$tabs['sizes'] = 'قیمت سایزها';
		}
		$tabs['about'] = 'معرفی';
		if ( $cmp['rows'] ) {
			$tabs['compare'] = 'مقایسه';
		}
		$tabs['faq'] = 'سؤالات';
		if ( $show_reviews ) {
			$tabs['reviews'] = 'نظرات';
		}
		$scale_max = ( $d['firmness'] && $d['firmness']['max'] ) ? $d['firmness']['max'] : 4;

		/* ویژگی‌های کلیدی زیر تصویر */
		$features = array();
		if ( $core && 'accessory' !== $core_key ) {
			$features[] = array( 'icon' => 'bed', 'label' => 'نوع هسته', 'value' => $core['title'] );
		} elseif ( $cat_term ) {
			$features[] = array( 'icon' => 'tag', 'label' => 'دسته‌بندی', 'value' => $cat_term->name );
		}
		if ( $d['firmness'] ) {
			$features[] = array( 'icon' => 'gauge', 'label' => 'سفتی', 'value' => $d['firmness']['name'], 'note' => ( $d['firmness']['level'] && $d['firmness']['max'] ) ? $fa( $d['firmness']['level'] ) . ' از ' . $fa( $d['firmness']['max'] ) : '', 'meter' => $d['firmness']['max'] ? array( $d['firmness']['level'], $d['firmness']['max'] ) : null );
		}
		if ( $d['warranty'] ) {
			$features[] = array( 'icon' => 'shield', 'label' => 'گارانتی', 'value' => $fa( $d['warranty'] ) );
		}
		if ( $d['layer'] ) {
			$features[] = array( 'icon' => 'layers', 'label' => 'چیدمان لایه‌ها', 'value' => $d['layer']['name'] );
		}
		foreach ( $d['details'] as $group ) {
			$features[] = array( 'icon' => $group['icon'], 'label' => $group['label'], 'value' => $group['value'] );
		}
		if ( $size_texts ) {
			$features[] = array( 'icon' => 'ruler', 'label' => 'سایزها', 'value' => 1 === count( $size_texts ) ? $size_texts[0] : $fa( count( $size_texts ) ) . ' سایز', 'note' => count( $size_texts ) > 1 ? $size_texts[0] . ' تا ' . $size_texts[ count( $size_texts ) - 1 ] : '' );
		}
		foreach ( $d['extra'] as $row ) {
			$features[] = array( 'icon' => 'check', 'label' => $row['label'], 'value' => $fa( $row['value'] ) );
		}

		/* داده جدول مقایسه */
		$cmp_cells = array();
		$cmp_range = array();
		$cmp_sizes = array();
		$cmp_cols  = array( 'core' => 'نوع هسته', 'firm' => 'سفتی', 'warranty' => 'گارانتی', 'layer' => 'چیدمان لایه‌ها', 'spring' => 'نوع فنر', 'special' => 'لایه ویژه', 'fabric' => 'جنس پارچه', 'sizes' => 'سایزها' );
		foreach ( $cmp['rows'] as $rid => $row ) {
			$sizes             = array_values( $row['sizes'] );
			$cmp_cells[ $rid ] = array(
				'core'     => $row['core'] ? $row['core']['title'] : $row['category'],
				'firm'     => $row['firm'],
				'warranty' => '' !== $row['warranty'] ? $fa( $row['warranty'] ) : '',
				'layer'    => $row['layer'],
				'spring'   => isset( $row['details']['spring'] ) ? $row['details']['spring']['value'] : '',
				'special'  => isset( $row['details']['special'] ) ? $row['details']['special']['value'] : '',
				'fabric'   => isset( $row['details']['fabric'] ) ? $row['details']['fabric']['value'] : '',
				'sizes'    => $sizes ? ( 1 === count( $sizes ) ? $sizes[0] : $fa( count( $sizes ) ) . ' سایز، ' . $sizes[0] . ' تا ' . $sizes[ count( $sizes ) - 1 ] ) : '',
			);
			foreach ( $row['extra'] as $extra ) {
				$cmp_cols[ 'x:' . $extra['label'] ]         = $extra['label'];
				$cmp_cells[ $rid ][ 'x:' . $extra['label'] ] = $fa( $extra['value'] );
			}
			foreach ( $row['sizes'] as $slug => $label ) {
				if ( ! isset( $cmp_sizes[ $slug ] ) ) {
					$cmp_sizes[ $slug ] = $label;
				}
			}
			$cmp_range[ $rid ] = $row['min'] > 0 ? ( $row['max'] > $row['min'] ? higer_product_number( $row['min'] ) . ' تا ' . higer_product_money( $row['max'] ) : higer_product_money( $row['min'] ) ) : '—';
		}
		uksort( $cmp_sizes, 'higer_product_size_compare' );
		foreach ( array_keys( $cmp_cols ) as $col ) {
			$used = false;
			foreach ( $cmp_cells as $cells ) {
				if ( isset( $cells[ $col ] ) && '' !== $cells[ $col ] ) {
					$used = true;
					break;
				}
			}
			if ( ! $used ) {
				unset( $cmp_cols[ $col ] );
			}
		}

		/* داده لازم برای اسکریپت (انتخاب سایز و به‌روزرسانی قیمت) */
		$payload = array(
			'name'         => $d['name'],
			'variable'     => $d['variable'],
			'purchasable'  => $can_buy,
			'inStock'      => $d['in_stock'],
			'maxQty'       => $d['max_qty'] > 0 ? $d['max_qty'] : 0,
			'stickyOffset' => isset( $cfg['sticky_offset'] ) ? max( 0, (int) $cfg['sticky_offset'] ) : 0,
			'rangeText'    => '' !== $d['range_text'] ? $d['range_text'] : 'برای استعلام قیمت تماس بگیرید',
			'rangeLabel'   => ( $d['variable'] && $d['max'] > $d['min'] ) ? 'محدوده قیمت' : 'قیمت',
			'sizeKey'      => $size_opt ? $size_key : '',
			'prompts'      => $prompts,
			'defaults'     => $defaults,
			'options'      => array(),
			'variations'   => $d['variations'],
		);
		foreach ( $d['options'] as $key => $option ) {
			$payload['options'][ $key ] = array();
			foreach ( $option['values'] as $value => $label ) {
				$payload['options'][ $key ][] = array( 'value' => (string) $value, 'label' => $option['is_size'] ? higer_product_size_text( $value, $label ) : $label );
			}
		}

		if ( $cmp['rows'] ) {
			$payload['compare'] = array(
				'current'  => (int) $d['id'],
				'ids'      => array_map( 'intval', array_keys( $cmp['rows'] ) ),
				'defaults' => array_map( 'intval', $cmp['defaults'] ),
				'range'    => $cmp_range,
				'sizes'    => $cmp_sizes,
				'prices'   => array(),
			);
			foreach ( $cmp['rows'] as $rid => $row ) {
				foreach ( $row['prices'] as $slug => $amount ) {
					$payload['compare']['prices'][ $rid ][ $slug ] = higer_product_money( $amount );
				}
			}
		}

		ob_start();
		echo higer_product_assets(); // phpcs:ignore
		?>
<div class="higer-product" id="<?php echo esc_attr( $uid ); ?>" dir="rtl" lang="fa" data-hp-fw="<?php echo 'no' === strtolower( (string) $atts['fullwidth'] ) ? 'no' : 'yes'; ?>">
	<script type="application/json" data-hp-data><?php echo wp_json_encode( $payload, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?></script>
	<?php if ( '' !== trim( $notices ) ) : ?><div class="hp-wrap hp-notices"><?php echo $notices; // phpcs:ignore ?></div><?php endif; ?>

	<!-- ===== مسیر صفحه ===== -->
	<nav class="hp-crumbs" aria-label="مسیر صفحه">
		<ol class="hp-wrap">
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a></li>
			<?php if ( $d['category'] ) : foreach ( $d['category']['path'] as $crumb ) : $crumb_url = higer_product_term_url( $crumb ); ?>
			<li><?php if ( $crumb_url ) : ?><a href="<?php echo esc_url( $crumb_url ); ?>"><?php echo esc_html( $crumb->name ); ?></a><?php else : echo esc_html( $crumb->name ); endif; ?></li>
			<?php endforeach; endif; ?>
			<li aria-current="page"><?php echo esc_html( $d['name'] ); ?></li>
		</ol>
	</nav>

	<!-- ===== بالای صفحه: تصاویر و خرید ===== -->
	<section class="hp-top">
		<div class="hp-wrap hp-top-grid">
			<div class="hp-gallery">
				<div class="hp-stage" data-hp-stage tabindex="0" aria-label="تصاویر محصول">
					<?php $slide = 0; foreach ( $d['images'] as $image ) : ?>
					<figure class="hp-slide<?php echo 0 === $slide ? ' is-active' : ''; ?>" data-hp-slide="<?php echo (int) $slide; ?>"><img src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"<?php echo $slide ? ' loading="lazy"' : ''; ?> decoding="async"></figure>
					<?php $slide++; endforeach; ?>
					<figure class="hp-slide hp-slide-diagram<?php echo 0 === $slide ? ' is-active' : ''; ?>" data-hp-slide="<?php echo (int) $slide; ?>">
						<?php echo higer_product_core_svg( $core_key ); // phpcs:ignore ?>
						<figcaption><?php echo esc_html( $core ? ( 'accessory' === $core_key ? 'طرح شماتیک ' . $core['title'] : 'طرح شماتیک هسته ' . $core['title'] ) : 'طرح شماتیک محصول' ); ?></figcaption>
					</figure>
					<?php $slides = $slide + 1; ?>
					<?php if ( $d['warranty'] ) : ?><span class="hp-stage-badge"><?php echo higer_product_icon( 'shield', 14 ); // phpcs:ignore ?> گارانتی <?php echo esc_html( $fa( $d['warranty'] ) ); ?></span><?php endif; ?>
					<?php if ( $slides > 1 ) : ?>
					<div class="hp-stage-nav">
						<button type="button" class="hp-round" data-hp-step="-1" aria-label="تصویر قبلی"><?php echo higer_product_icon( 'chevron-right', 18 ); // phpcs:ignore ?></button>
						<button type="button" class="hp-round" data-hp-step="1" aria-label="تصویر بعدی"><?php echo higer_product_icon( 'chevron-left', 18 ); // phpcs:ignore ?></button>
					</div>
					<?php endif; ?>
				</div>
				<?php if ( $slides > 1 ) : ?>
				<div class="hp-thumbs">
					<?php foreach ( $d['images'] as $i => $image ) : ?>
					<button type="button" class="hp-thumb" data-hp-thumb="<?php echo (int) $i; ?>" aria-label="تصویر <?php echo esc_attr( $fa( $i + 1 ) ); ?>" aria-current="<?php echo 0 === $i ? 'true' : 'false'; ?>"><img src="<?php echo esc_url( $image['thumb'] ); ?>" alt="" loading="lazy"></button>
					<?php endforeach; ?>
					<button type="button" class="hp-thumb hp-thumb-diagram" data-hp-thumb="<?php echo (int) ( $slides - 1 ); ?>" aria-label="طرح شماتیک" aria-current="false"><?php echo higer_product_core_svg( $core_key ); // phpcs:ignore ?></button>
				</div>
				<?php endif; ?>
				<?php if ( $features ) : ?>
				<ul class="hp-keys" aria-label="ویژگی‌های کلیدی">
					<?php foreach ( $features as $feature ) : ?>
					<li class="hp-key">
						<i><?php echo higer_product_icon( $feature['icon'], 18 ); // phpcs:ignore ?></i>
						<span>
							<small><?php echo esc_html( $feature['label'] ); ?></small>
							<b><?php echo esc_html( $feature['value'] ); ?><?php if ( ! empty( $feature['note'] ) ) : ?> <em><?php echo esc_html( $feature['note'] ); ?></em><?php endif; ?></b>
							<?php if ( ! empty( $feature['meter'] ) ) : ?><span class="hp-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $feature['meter'][1]; $i++ ) : ?><i<?php echo $i <= $feature['meter'][0] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?>
						</span>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>

			<div class="hp-buy" data-hp-buy>
				<div class="hp-card hp-buy-card">
					<div class="hp-buy-tags">
						<?php if ( $cat_term ) : ?><a class="hp-kicker" href="<?php echo esc_url( $cat_url ? $cat_url : '#' ); ?>"><?php echo higer_product_icon( 'layers', 13 ); // phpcs:ignore ?> <?php echo esc_html( $cat_term->name ); ?></a><?php endif; ?>
						<span class="hp-stock<?php echo $d['in_stock'] ? '' : ' is-out'; ?>" data-hp-stock><?php echo $d['in_stock'] ? 'موجود' : 'ناموجود'; ?></span>
					</div>
					<h1 class="hp-title"><?php echo esc_html( $d['name'] ); ?></h1>
					<?php if ( '' !== $d['short'] ) : ?><p class="hp-subtitle"><?php echo esc_html( $d['short'] ); ?></p><?php endif; ?>
					<?php if ( $d['reviews'] > 0 || '' !== $d['sku'] ) : ?>
					<div class="hp-meta">
						<?php if ( $d['reviews'] > 0 ) : ?><a class="hp-rating" href="#<?php echo esc_attr( $uid ); ?>-reviews"><?php echo higer_product_icon( 'star', 14 ); // phpcs:ignore ?> <?php echo esc_html( $fa( number_format( $d['rating'], 1 ) ) ); ?> <small>(<?php echo esc_html( $fa( $d['reviews'] ) ); ?> نظر)</small></a><?php endif; ?>
						<?php if ( '' !== $d['sku'] ) : ?><span>کد محصول: <bdi><?php echo esc_html( $d['sku'] ); ?></bdi></span><?php endif; ?>
					</div>
					<?php endif; ?>

					<div class="hp-price-box">
						<span class="hp-price-label" data-hp-price-label><?php echo esc_html( $payload['rangeLabel'] ); ?></span>
						<div class="hp-price-row">
							<strong class="hp-price" data-hp-price><?php echo esc_html( $payload['rangeText'] ); ?></strong>
							<del class="hp-regular" data-hp-regular<?php echo $d['regular'] > $d['min'] ? '' : ' hidden'; ?>><?php echo $d['regular'] > $d['min'] ? esc_html( higer_product_money( $d['regular'] ) ) : ''; ?></del>
						</div>
					</div>

					<form class="hp-form cart" method="post" enctype="multipart/form-data" action="<?php echo esc_url( $d['url'] ); ?>" data-hp-form>
						<?php foreach ( $visible as $key => $option ) : ?>
						<div class="hp-opt" role="group" aria-labelledby="<?php echo esc_attr( $uid . '-opt-' . $key ); ?>">
							<div class="hp-opt-head">
								<h3 id="<?php echo esc_attr( $uid . '-opt-' . $key ); ?>"><?php echo esc_html( $option['is_size'] ? 'انتخاب سایز' : $option['label'] ); ?></h3>
								<span data-hp-selected="<?php echo esc_attr( $key ); ?>">انتخاب نشده</span>
							</div>
							<div class="hp-choices">
								<?php foreach ( $option['values'] as $value => $label ) :
									$value = (string) $value;
									$from  = $option['from'][ $value ];
									$ok    = ! empty( $option['stock'][ $value ] ); ?>
								<button type="button" class="hp-choice" data-hp-opt="<?php echo esc_attr( $key ); ?>" data-value="<?php echo esc_attr( $value ); ?>" aria-pressed="false"<?php echo $ok ? '' : ' disabled'; ?>>
									<b><?php echo esc_html( $option['is_size'] ? higer_product_size_text( $value, $label ) : $label ); ?></b>
									<?php if ( $option['is_size'] ) : ?><small><?php echo esc_html( isset( $cfg['size_labels'][ $value ] ) ? $cfg['size_labels'][ $value ] : '' ); ?></small><?php endif; ?>
									<span class="hp-choice-price"><?php echo $ok ? ( null !== $from ? esc_html( higer_product_number( $from ) ) : '' ) : 'ناموجود'; ?></span>
								</button>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endforeach; ?>
						<?php foreach ( $d['options'] as $key => $option ) : ?>
						<input type="hidden" name="attribute_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' ); ?>" data-hp-attr-input="<?php echo esc_attr( $key ); ?>">
						<?php endforeach; ?>
						<?php if ( $d['variable'] ) : ?><input type="hidden" name="variation_id" value="" data-hp-variation><?php endif; ?>
						<input type="hidden" name="add-to-cart" value="<?php echo (int) $d['id']; ?>">
						<input type="hidden" name="product_id" value="<?php echo (int) $d['id']; ?>">
						<div class="hp-form-foot">
							<div class="hp-qty">
								<button type="button" data-hp-qty="1" aria-label="افزایش تعداد"><?php echo higer_product_icon( 'plus', 16 ); // phpcs:ignore ?></button>
								<input class="hp-qty-input" type="number" name="quantity" value="<?php echo (int) $d['min_qty']; ?>" min="<?php echo (int) $d['min_qty']; ?>"<?php echo $d['max_qty'] > 0 ? ' max="' . (int) $d['max_qty'] . '"' : ''; ?> step="1" inputmode="numeric" aria-label="تعداد" data-hp-qty-input>
								<button type="button" data-hp-qty="-1" aria-label="کاهش تعداد"><?php echo higer_product_icon( 'minus', 16 ); // phpcs:ignore ?></button>
							</div>
							<button type="submit" class="hp-btn-gold hp-add" data-hp-add<?php echo ( $d['variable'] || ! $can_buy ) ? ' disabled' : ''; ?>><?php echo higer_product_icon( 'cart', 18 ); // phpcs:ignore ?> افزودن به سبد خرید</button>
						</div>
						<p class="hp-hint" data-hp-hint role="status" aria-live="polite"><?php echo esc_html( $hint ); ?></p>
					</form>

					<div class="hp-buy-links<?php echo $cmp['rows'] ? '' : ' is-single'; ?>">
						<?php if ( $cmp['rows'] ) : ?><button type="button" class="hp-link-btn hp-cmp-toggle" data-hp-cmp-toggle="<?php echo (int) $d['id']; ?>" aria-pressed="false"><span class="hp-cmp-off"><?php echo higer_product_icon( 'compare', 16 ); // phpcs:ignore ?> افزودن به مقایسه</span><span class="hp-cmp-on"><?php echo higer_product_icon( 'check', 16 ); // phpcs:ignore ?> در فهرست مقایسه</span></button><?php endif; ?>
						<a class="hp-link-btn" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_product_icon( 'phone', 16 ); // phpcs:ignore ?> تماس با فروشگاه</a>
					</div>

					<?php if ( ! empty( $cfg['finder_path'] ) ) : ?>
					<a class="hp-finder-cta" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
						<span class="hp-finder-ico" aria-hidden="true"><?php echo higer_product_icon( 'sparkles', 20 ); // phpcs:ignore ?></span>
						<span class="hp-finder-copy">
							<b>تشک‌سنج هیگر</b>
							<small>مطمئن نیستید این مدل مناسب شماست؟ با چند سؤال بررسی کنید</small>
						</span>
						<span class="hp-finder-go">شروع <?php echo higer_product_icon( 'chevron-left', 14 ); // phpcs:ignore ?></span>
					</a>
					<?php endif; ?>

					<?php if ( ! empty( $cfg['purchase_info'] ) ) : ?>
					<ul class="hp-facts">
						<?php foreach ( $cfg['purchase_info'] as $fact ) : ?>
						<li><i><?php echo higer_product_icon( $fact['icon'], 16 ); // phpcs:ignore ?></i><span><b><?php echo esc_html( $fact['title'] ); ?>:</b> <?php echo esc_html( $fact['text'] ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ===== منوی بخش‌ها ===== -->
	<nav class="hp-tabs" data-hp-tabs aria-label="بخش‌های صفحه">
		<div class="hp-wrap hp-tabs-inner">
			<?php foreach ( $tabs as $key => $label ) : ?><a class="hp-tab" href="#<?php echo esc_attr( $uid . '-' . $key ); ?>"><?php echo esc_html( $label ); ?><?php if ( 'compare' === $key ) : ?> <span class="hp-tab-count" data-hp-cmp-badge hidden></span><?php endif; ?></a><?php endforeach; ?>
		</div>
	</nav>

	<!-- ===== مشخصات ===== -->
	<section class="hp-sec" id="<?php echo esc_attr( $uid ); ?>-specs" data-hp-section>
		<div class="hp-wrap">
			<div class="hp-head">
				<span class="hp-kicker"><?php echo higer_product_icon( 'ruler', 13 ); // phpcs:ignore ?> مشخصات فنی</span>
				<h2 class="hp-h2">مشخصات <span class="hp-gold-text"><?php echo esc_html( $d['name'] ); ?></span></h2>
				<p class="hp-lead">اطلاعات این بخش از مشخصات ثبت‌شده محصول در فروشگاه خوانده می‌شود.</p>
			</div>
			<div class="hp-spec-grid">
				<div class="hp-table-card">
					<table class="hp-table hp-spec-table">
						<tbody>
							<tr><th scope="row">نام مدل</th><td><?php echo esc_html( $d['name'] ); ?></td></tr>
							<?php if ( $d['category'] ) : ?><tr><th scope="row">دسته‌بندی</th><td><?php echo esc_html( implode( ' › ', wp_list_pluck( $d['category']['path'], 'name' ) ) ); ?></td></tr><?php endif; ?>
							<?php if ( $core && 'accessory' !== $core_key ) : ?><tr><th scope="row">نوع هسته</th><td><?php echo esc_html( $core['title'] ); ?></td></tr><?php endif; ?>
							<?php if ( $d['firmness'] ) : ?><tr><th scope="row">سفتی</th><td><?php echo esc_html( $d['firmness']['name'] ); ?><?php if ( $d['firmness']['level'] && $d['firmness']['max'] ) : ?> <span class="hp-muted">(<?php echo esc_html( $fa( $d['firmness']['level'] ) . ' از ' . $fa( $d['firmness']['max'] ) ); ?>)</span><?php endif; ?></td></tr><?php endif; ?>
							<?php if ( $d['warranty'] ) : ?><tr><th scope="row">گارانتی</th><td><?php echo esc_html( $fa( $d['warranty'] ) ); ?></td></tr><?php endif; ?>
							<?php if ( $d['layer'] ) : ?><tr><th scope="row">چیدمان لایه‌ها</th><td><?php echo esc_html( $d['layer']['name'] ); ?></td></tr><?php endif; ?>
							<?php foreach ( $d['details'] as $group ) : ?><tr><th scope="row"><?php echo esc_html( $group['label'] ); ?></th><td><?php echo esc_html( $group['value'] ); ?></td></tr><?php endforeach; ?>
							<?php if ( $size_texts ) : ?><tr><th scope="row">سایزهای موجود</th><td><?php echo esc_html( implode( '، ', $size_texts ) ); ?></td></tr><?php endif; ?>
							<?php foreach ( $d['extra'] as $row ) : ?><tr><th scope="row"><?php echo esc_html( $row['label'] ); ?></th><td><?php echo esc_html( $fa( $row['value'] ) ); ?></td></tr><?php endforeach; ?>
							<?php if ( '' !== $d['sku'] ) : ?><tr><th scope="row">کد محصول</th><td><bdi><?php echo esc_html( $d['sku'] ); ?></bdi></td></tr><?php endif; ?>
							<tr><th scope="row">وضعیت</th><td><?php echo $d['in_stock'] ? 'موجود' : 'ناموجود'; ?></td></tr>
						</tbody>
					</table>
				</div>
				<div class="hp-side">
					<?php if ( $d['firmness'] && $d['firmness']['scale'] ) : ?>
					<div class="hp-navy-card">
						<p class="hp-navy-head"><?php echo higer_product_icon( 'gauge', 16 ); // phpcs:ignore ?> سطح سفتی</p>
						<p class="hp-navy-value"><?php echo esc_html( $d['firmness']['name'] ); ?> <small>(<?php echo esc_html( $fa( $d['firmness']['level'] ) . ' از ' . $fa( $d['firmness']['max'] ) ); ?>)</small></p>
						<div class="hp-firm-scale">
							<?php foreach ( $d['firmness']['scale'] as $level => $label ) : ?>
							<div class="<?php echo esc_attr( trim( ( $level <= $d['firmness']['level'] ? 'is-on' : '' ) . ( $level === $d['firmness']['level'] ? ' is-current' : '' ) ) ); ?>"><i></i><span><?php echo esc_html( $label ); ?></span></div>
							<?php endforeach; ?>
						</div>
						<p class="hp-navy-note">سفتی تشک‌ها در فروشگاه هیگر در <?php echo esc_html( $fa( $d['firmness']['max'] ) ); ?> سطح ثبت می‌شود.</p>
					</div>
					<?php endif; ?>
					<?php if ( $d['layer'] ) : ?>
					<div class="hp-card hp-layer-card">
						<?php echo higer_product_layer_svg( $d['layer']['slug'] ); // phpcs:ignore ?>
						<div>
							<small>چیدمان لایه‌ها</small>
							<b><?php echo esc_html( $d['layer']['name'] ); ?></b>
							<?php if ( '' !== $d['layer']['text'] ) : ?><p><?php echo esc_html( $d['layer']['text'] ); ?></p><?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( ! $d['firmness'] && ! $d['layer'] ) : ?>
					<div class="hp-navy-card">
						<p class="hp-navy-head"><?php echo higer_product_icon( 'phone', 16 ); // phpcs:ignore ?> راهنمایی خرید</p>
						<p class="hp-navy-note">برای اطلاعات بیشتر درباره این محصول با فروشگاه تماس بگیرید.</p>
						<a class="hp-btn-outline" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo esc_html( $store['phone'] ); ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $d['details'] ) : ?>
			<div class="hp-build" id="<?php echo esc_attr( $uid ); ?>-build" data-hp-section>
				<div class="hp-head">
					<span class="hp-kicker"><?php echo higer_product_icon( 'layers', 13 ); // phpcs:ignore ?> ساختار و مواد</span>
					<h3 class="hp-h3">از <span class="hp-gold-text">چه ساخته شده؟</span></h3>
				</div>
				<div class="hp-detail-grid">
					<?php foreach ( $d['details'] as $gkey => $group ) : foreach ( $group['items'] as $detail ) : ?>
					<article class="hp-navy-card hp-detail-card" data-hp-detail="<?php echo esc_attr( $gkey ); ?>">
						<div class="hp-detail-art"><?php echo higer_product_detail_svg( $gkey, $detail['slug'] ); // phpcs:ignore ?></div>
						<small><?php echo higer_product_icon( $group['icon'], 13 ); // phpcs:ignore ?> <?php echo esc_html( $group['label'] ); ?></small>
						<h4><?php echo esc_html( $detail['title'] ); ?></h4>
						<?php if ( '' !== $detail['text'] ) : ?><p><?php echo esc_html( $detail['text'] ); ?></p><?php endif; ?>
					</article>
					<?php endforeach; endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<?php if ( $size_opt ) : ?>
	<!-- ===== قیمت هر سایز ===== -->
	<section class="hp-sec hp-paper" id="<?php echo esc_attr( $uid ); ?>-sizes" data-hp-section>
		<div class="hp-wrap">
			<div class="hp-head">
				<span class="hp-kicker"><?php echo higer_product_icon( 'table', 13 ); // phpcs:ignore ?> سایز و قیمت</span>
				<h2 class="hp-h2">قیمت <span class="hp-gold-text">هر سایز</span></h2>
				<p class="hp-lead">با دکمه «انتخاب»، همان سایز در فرم خرید انتخاب می‌شود.</p>
			</div>
			<div class="hp-table-card hp-scroll">
				<table class="hp-table hp-size-table">
					<thead><tr><th scope="col">سایز</th><th scope="col">عنوان</th><th scope="col">قیمت</th><th scope="col">موجودی</th><th scope="col"><span class="hp-sr">انتخاب</span></th></tr></thead>
					<tbody>
						<?php foreach ( $size_opt['values'] as $value => $label ) :
							$value = (string) $value;
							$from  = $size_opt['from'][ $value ];
							$ok    = ! empty( $size_opt['stock'][ $value ] );
							$usage = isset( $cfg['size_labels'][ $value ] ) ? $cfg['size_labels'][ $value ] : ''; ?>
						<tr data-hp-row="<?php echo esc_attr( $value ); ?>">
							<td><b><?php echo esc_html( higer_product_size_text( $value, $label ) ); ?></b></td>
							<td><?php echo esc_html( '' !== $usage ? $usage : '—' ); ?></td>
							<td><?php echo null !== $from ? esc_html( higer_product_money( $from ) ) : '—'; ?></td>
							<td><span class="hp-dot<?php echo $ok ? '' : ' is-out'; ?>"></span><?php echo $ok ? 'موجود' : 'ناموجود'; ?></td>
							<td><button type="button" class="hp-pick" data-hp-pick="<?php echo esc_attr( $size_key ); ?>" data-value="<?php echo esc_attr( $value ); ?>"<?php echo ( $ok && count( $size_opt['values'] ) > 1 ) ? '' : ' disabled'; ?>>انتخاب</button></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<p class="hp-table-note">ابعاد بر حسب سانتی‌متر است.</p>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== معرفی و نوع هسته ===== -->
	<section class="hp-sec" id="<?php echo esc_attr( $uid ); ?>-about" data-hp-section>
		<div class="hp-wrap">
			<div class="hp-about-grid<?php echo $core ? '' : ' is-single'; ?>">
				<div class="hp-card hp-about-card">
					<span class="hp-kicker">معرفی محصول</span>
					<h2 class="hp-h2"><?php echo esc_html( '' !== $d['short'] ? $d['short'] : $d['name'] ); ?></h2>
					<div class="hp-prose"><?php echo '' !== $description ? $description : '<p>توضیحات تکمیلی این محصول هنوز در فروشگاه ثبت نشده است. برای اطلاعات بیشتر با فروشگاه تماس بگیرید.</p>'; // phpcs:ignore ?></div>
				</div>
				<?php if ( $core ) : ?>
				<div class="hp-navy-card hp-core-card">
					<?php echo higer_product_core_svg( $core_key ); // phpcs:ignore ?>
					<small><?php echo 'accessory' === $core_key ? 'دسته محصول' : 'نوع هسته'; ?></small>
					<h3><?php echo esc_html( $core['title'] ); ?></h3>
					<p><?php echo esc_html( $core['text'] ); ?></p>
					<?php if ( $core_url ) : ?><a class="hp-btn-outline" href="<?php echo esc_url( $core_url ); ?>">همه مدل‌های <?php echo esc_html( $core['term']->name ); ?></a><?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php if ( $cmp['rows'] ) : ?>
	<!-- ===== مقایسه ===== -->
	<section class="hp-sec hp-paper" id="<?php echo esc_attr( $uid ); ?>-compare" data-hp-section data-hp-cmp>
		<div class="hp-wrap">
			<div class="hp-head">
				<span class="hp-kicker"><?php echo higer_product_icon( 'compare', 13 ); // phpcs:ignore ?> مقایسه</span>
				<h2 class="hp-h2">مقایسه <span class="hp-gold-text">مدل‌ها</span></h2>
				<p class="hp-lead">فقط مدل‌های موجود نمایش داده می‌شوند. با «افزودن» کنار هر مدل، فقط مدل‌های دلخواه را مقایسه کنید.</p>
			</div>
			<div class="hp-cmp-bar">
				<div class="hp-seg" role="group" aria-label="مدل‌های جدول مقایسه">
					<button type="button" data-hp-cmp-mode="all" aria-pressed="true">مدل‌های <?php echo esc_html( $cmp['term']->name ); ?> <span>(<?php echo esc_html( $fa( count( $cmp['defaults'] ) ) ); ?>)</span></button>
					<button type="button" data-hp-cmp-mode="selected" aria-pressed="false" disabled>انتخاب‌شده‌ها <span data-hp-cmp-count>(۰)</span></button>
				</div>
				<?php if ( count( $cmp_sizes ) > 1 ) : ?>
				<label class="hp-cmp-size"><span>قیمت در سایز</span>
					<select data-hp-cmp-size>
						<option value="">محدوده قیمت</option>
						<?php foreach ( $cmp_sizes as $slug => $label ) : ?><option value="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></option><?php endforeach; ?>
					</select>
				</label>
				<?php endif; ?>
				<button type="button" class="hp-cmp-clear" data-hp-cmp-clear hidden>پاک کردن فهرست مقایسه</button>
			</div>
			<p class="hp-cmp-help" data-hp-cmp-help role="status" aria-live="polite"></p>
			<div class="hp-table-card hp-scroll">
				<table class="hp-table hp-compare-table">
					<thead><tr><th scope="col">مدل</th><?php foreach ( $cmp_cols as $label ) : ?><th scope="col"><?php echo esc_html( $label ); ?></th><?php endforeach; ?><th scope="col" data-hp-cmp-price-head>محدوده قیمت</th><th scope="col"><span class="hp-sr">افزودن به مقایسه</span></th></tr></thead>
					<tbody>
						<?php foreach ( $cmp['rows'] as $rid => $row ) : $is_current = ( (int) $rid === (int) $d['id'] ); ?>
						<tr data-hp-cmp-row="<?php echo (int) $rid; ?>"<?php echo $is_current ? ' class="is-current"' : ''; ?><?php echo in_array( (int) $rid, $cmp['defaults'], true ) ? '' : ' hidden'; ?>>
							<th scope="row"><?php if ( $is_current ) : ?><b><?php echo esc_html( $row['name'] ); ?></b> <span class="hp-here">همین مدل</span><?php else : ?><a href="<?php echo esc_url( $row['url'] ); ?>"><?php echo esc_html( $row['name'] ); ?></a><?php endif; ?><?php if ( empty( $row['in_stock'] ) ) : ?> <span class="hp-out">ناموجود</span><?php endif; ?></th>
							<?php foreach ( $cmp_cols as $col => $label ) : $value = isset( $cmp_cells[ $rid ][ $col ] ) ? $cmp_cells[ $rid ][ $col ] : ''; ?>
							<td><?php echo esc_html( '' !== $value ? $value : '—' ); ?><?php if ( 'firm' === $col && $row['firm_level'] ) : ?><span class="hp-mini-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $scale_max; $i++ ) : ?><i<?php echo $i <= $row['firm_level'] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?></td>
							<?php endforeach; ?>
							<td class="hp-cmp-price" data-hp-cmp-price="<?php echo (int) $rid; ?>"><?php echo esc_html( $cmp_range[ $rid ] ); ?></td>
							<td><button type="button" class="hp-cmp-row-btn" data-hp-cmp-toggle="<?php echo (int) $rid; ?>" aria-pressed="false" aria-label="<?php echo esc_attr( 'افزودن ' . $row['name'] . ' به مقایسه' ); ?>"><span class="hp-cmp-off"><?php echo higer_product_icon( 'plus', 14 ); // phpcs:ignore ?> افزودن</span><span class="hp-cmp-on"><?php echo higer_product_icon( 'check', 14 ); // phpcs:ignore ?> انتخاب شد</span></button></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php $cmp_others = array_diff( array_map( 'intval', array_keys( $cmp['rows'] ) ), $cmp['defaults'] ); ?>
			<?php if ( $cmp_others ) : ?>
			<details class="hp-cmp-more">
				<summary>افزودن مدل از دسته‌های دیگر</summary>
				<div class="hp-cmp-chips">
					<?php foreach ( $cmp_others as $rid ) : $row = $cmp['rows'][ $rid ]; ?>
					<button type="button" class="hp-cmp-chip" data-hp-cmp-toggle="<?php echo (int) $rid; ?>" aria-pressed="false"><b><?php echo esc_html( $row['name'] ); ?></b><small><?php echo esc_html( $cmp_cells[ $rid ]['core'] ); ?></small></button>
					<?php endforeach; ?>
				</div>
			</details>
			<?php endif; ?>
			<p class="hp-table-note">مدل‌ها بر اساس شروع قیمت مرتب شده‌اند. فهرست مقایسه در این مرورگر ذخیره می‌شود و در صفحه محصولات دیگر هم در دسترس است.</p>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== سؤالات متداول ===== -->
	<section class="hp-sec" id="<?php echo esc_attr( $uid ); ?>-faq" data-hp-section>
		<div class="hp-wrap hp-narrow">
			<div class="hp-head hp-center">
				<span class="hp-kicker">سؤالات متداول</span>
				<h2 class="hp-h2">پیش از <span class="hp-gold-text">خرید</span></h2>
			</div>
			<?php foreach ( $faqs as $i => $faq ) : ?>
			<details class="hp-acc"<?php echo 0 === $i ? ' open' : ''; ?>><summary><?php echo esc_html( $faq['q'] ); ?></summary><div class="hp-acc-body"><?php echo esc_html( $faq['a'] ); ?></div></details>
			<?php endforeach; ?>
		</div>
	</section>

	<?php if ( $show_reviews ) : ?>
	<!-- ===== نظرات ===== -->
	<section class="hp-sec hp-paper" id="<?php echo esc_attr( $uid ); ?>-reviews" data-hp-section>
		<div class="hp-wrap hp-narrow">
			<div class="hp-head">
				<span class="hp-kicker"><?php echo higer_product_icon( 'star', 13 ); // phpcs:ignore ?> نظرات</span>
				<h2 class="hp-h2">نظرات <span class="hp-gold-text">خریداران</span></h2>
			</div>
			<div class="hp-card hp-review-box"><?php comments_template(); ?></div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $rel ) : ?>
	<!-- ===== محصولات مرتبط ===== -->
	<section class="hp-sec hp-related">
		<div class="hp-wrap">
			<div class="hp-head">
				<span class="hp-kicker">محصولات مرتبط</span>
				<h2 class="hp-h2">مدل‌های <span class="hp-gold-text">دیگر</span></h2>
			</div>
			<div class="hp-rel-grid">
				<?php foreach ( $rel as $r ) : ?>
				<article class="hp-card hp-rel-card">
					<a class="hp-rel-link" href="<?php echo esc_url( $r['url'] ); ?>">
						<span class="hp-rel-media"><?php if ( '' !== $r['image'] ) : ?><img src="<?php echo esc_url( $r['image'] ); ?>" alt="<?php echo esc_attr( $r['name'] ); ?>" loading="lazy"><?php else : echo higer_product_core_svg( $r['core'] ? $r['core']['key'] : 'generic' ); endif; // phpcs:ignore ?></span>
						<span class="hp-rel-body">
							<b><?php echo esc_html( $r['name'] ); ?></b>
							<span class="hp-rel-keys">
								<?php if ( $r['core'] || '' !== $r['category'] ) : ?><span><?php echo higer_product_icon( 'bed', 12 ); // phpcs:ignore ?> <?php echo esc_html( $r['core'] ? $r['core']['title'] : $r['category'] ); ?></span><?php endif; ?>
								<?php if ( '' !== $r['firm'] ) : ?><span><?php echo higer_product_icon( 'gauge', 12 ); // phpcs:ignore ?> <?php echo esc_html( $r['firm'] ); ?><?php if ( $r['firm_level'] ) : ?><span class="hp-mini-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $scale_max; $i++ ) : ?><i<?php echo $i <= $r['firm_level'] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?></span><?php endif; ?>
								<?php if ( '' !== $r['warranty'] ) : ?><span><?php echo higer_product_icon( 'shield', 12 ); // phpcs:ignore ?> گارانتی <?php echo esc_html( $fa( $r['warranty'] ) ); ?></span><?php endif; ?>
								<?php if ( '' !== $r['layer'] ) : ?><span><?php echo higer_product_icon( 'layers', 12 ); // phpcs:ignore ?> <?php echo esc_html( $r['layer'] ); ?></span><?php endif; ?>
							</span>
							<?php if ( $r['min'] > 0 ) : ?><span class="hp-rel-price">از <?php echo esc_html( higer_product_money( $r['min'] ) ); ?></span><?php endif; ?>
						</span>
					</a>
					<?php if ( isset( $cmp['rows'][ $r['id'] ] ) ) : ?><button type="button" class="hp-rel-cmp" data-hp-cmp-toggle="<?php echo (int) $r['id']; ?>" aria-pressed="false" aria-label="<?php echo esc_attr( 'افزودن ' . $r['name'] . ' به مقایسه' ); ?>"><span class="hp-cmp-off"><?php echo higer_product_icon( 'compare', 14 ); // phpcs:ignore ?> افزودن به مقایسه</span><span class="hp-cmp-on"><?php echo higer_product_icon( 'check', 14 ); // phpcs:ignore ?> در فهرست مقایسه</span></button><?php endif; ?>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== تماس ===== -->
	<section class="hp-cta">
		<div class="hp-wrap hp-cta-inner">
			<div>
				<span class="hp-kicker is-dark">مشاوره خرید</span>
				<h2>سؤالی درباره <span class="hp-gold-text"><?php echo esc_html( $d['name'] ); ?></span> دارید؟</h2>
				<p><?php echo higer_product_icon( 'map', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['address'] ); ?></p>
				<p><?php echo higer_product_icon( 'clock', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['hours'] ); ?></p>
			</div>
			<a class="hp-btn-gold" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_product_icon( 'phone', 18 ); // phpcs:ignore ?> <?php echo esc_html( $store['phone'] ); ?></a>
		</div>
	</section>

	<!-- ===== نوار خرید موبایل ===== -->
	<div class="hp-sticky" data-hp-sticky aria-hidden="true">
		<div class="hp-sticky-info"><small data-hp-sticky-label><?php echo esc_html( $prompts ? 'سایز انتخاب نشده' : $d['name'] ); ?></small><b data-hp-sticky-price><?php echo esc_html( $payload['rangeText'] ); ?></b></div>
		<button type="button" class="hp-btn-gold" data-hp-sticky-add tabindex="-1"><?php echo higer_product_icon( 'cart', 16 ); // phpcs:ignore ?> <span data-hp-sticky-text><?php echo $prompts ? 'انتخاب سایز' : 'افزودن به سبد'; ?></span></button>
	</div>
</div>
<?php
		$depth--;
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_product' ) ) {
	add_shortcode( 'higer_product', 'higer_product_render' );
}

if ( ! function_exists( 'higer_product_auto_replace' ) ) {
	/** حالت بدون المنتور: چیدمان پیش‌فرض ووکامرس با این صفحه جایگزین می‌شود. */
	function higer_product_auto_replace() {
		$cfg = higer_product_config();
		if ( empty( $cfg['auto_replace'] ) || ! function_exists( 'is_product' ) || ! is_product() ) {
			return;
		}
		remove_all_actions( 'woocommerce_before_single_product_summary' );
		remove_all_actions( 'woocommerce_single_product_summary' );
		remove_all_actions( 'woocommerce_after_single_product_summary' );
		add_action( 'woocommerce_before_single_product_summary', 'higer_product_auto_output', 5 );
	}
	function higer_product_auto_output() {
		echo higer_product_render(); // phpcs:ignore
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'template_redirect', 'higer_product_auto_replace', 20 );
	}
}
