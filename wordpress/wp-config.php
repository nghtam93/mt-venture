<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', "tam_mt-venture" );

/** Username của database */
define( 'DB_USER', "admin" );

/** Mật khẩu của database */
define( 'DB_PASSWORD', "123456" );

/** Hostname của database */
define( 'DB_HOST', "localhost" );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ejUBRkUWe@$|}r^mh?U<2T31}e;u>`y(jt9gnM12&Xt{I}gs#YOk7UnXM!jdCZ$~' );
define( 'SECURE_AUTH_KEY',  '~CG-:f @_I()m)4))=R8!We459ohLv!%RF0@:F9G>_QUNMp}8stpsPI`D.Z3r>:;' );
define( 'LOGGED_IN_KEY',    'r~~f(AKgn!a9T4EWG4t8:/=^BDhIs4[$%91G*X_s~V@}]0*<V&[V+^n>iOwYZ|XB' );
define( 'NONCE_KEY',        'Z5d|Ff1Uy9Ub+YmrwJt(!-WIb&XaL;/N8E/7C,rLPf(oB16Y}E>FqC+}L7jvw}K:' );
define( 'AUTH_SALT',        '.uGb md&pQ)H#{Z4,z~x*2-H~-&njdrl2hf7d$QW|iuJ6D(#hMl[,2#sxA(N{Q?f' );
define( 'SECURE_AUTH_SALT', 'x$tJO+,DDL[|mA:FYqL|BobOL([,21zF:<0<|@)>;)>bx Cx7@<+$XcZj?LtLF;j' );
define( 'LOGGED_IN_SALT',   'ivkQ>NS!Re7y 5s2n*$XWOE+Hj9L?qZL0dT@38|e~6*2<K@_N3hlD> ,HaZpxF-v' );
define( 'NONCE_SALT',       '<FgvlY!u#>F5tM%CFvnT|/xWW-)MjGyWHKDyl2}z?aF)pMLa&VQ6;wK G7,%j{+U' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wpz_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

define('WPCF7_AUTOP', false );
define( 'WP_POST_REVISIONS', 10 );

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
