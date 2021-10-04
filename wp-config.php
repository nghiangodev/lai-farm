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
define( 'DB_NAME', 'laifarm' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'LjK.t~c9yq!l7/kmgHsaO*Oh@TL-knoR. =IB}@9kWa8CY&*wxXD- k6pyo|qHW1' );
define( 'SECURE_AUTH_KEY',  '-ha2g>JfQ;}T;bgYd#F/Wy[Ws[f(RO]f5.^UMSH%/g`Nj(zP|+123M!VtoN<:gO@' );
define( 'LOGGED_IN_KEY',    '^$=5At]|PVcB*o/[7;!(SPrnR6s@aOmK}Kg)x1213K{(kf:xU5>SB3S(.p}Qa%A,' );
define( 'NONCE_KEY',        '6jt&k539$@b?O4?_&P],l6uyUqQ+Fi/VZc6J4J<L0w/qZ-7]1lJV.D2wDz]9-#bo' );
define( 'AUTH_SALT',        'sn*}4~sJt$uXX^9Rec_>MVtuj$=T%8 Ivm9>e3sQcaM;6[n4YEKa`:v&xY52Z_ZM' );
define( 'SECURE_AUTH_SALT', '6*[;6UP{},<7!~r3g{75Sn)8fDU=>IaLtj(ZLw9>YElYm6p$4%V_/([c#Trzy2Ss' );
define( 'LOGGED_IN_SALT',   '|9c{LT.,&5I)PLtpw#1]?94ci9ARiR($J&pc hR+>$(lLFE W/RRQIVBi}_PN_!s' );
define( 'NONCE_SALT',       '$+7u9tuG-f`{a$x U1/mV:NGnJTHDd2Tx={WlPTYDyByO7l?J W-Q<_;!MOMGct`' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

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
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
