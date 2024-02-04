# Sistem Administrasi Manajemen Sekolah

## Credit
Code Igniter 4.4.4 https://github.com/codeigniter4/CodeIgniter4  
Bootstrap 5.1 https://getbootstrap.com/docs/5.1/getting-started/introduction/  
JQuery 3.6 https://jquery.com/  
shield https://shield.codeigniter.com/  

## Installasi  
```bash
apt -y install php-intl php-curl php-mbstring php-xml php-mysql zip unzip php-zip
git clone https://github.com/dangdeur/sims  
```
## Pengaturan
```bash
cp env .env  
```
Sesuaikan .env  
```
database.default.hostname = localhost  
database.default.database = sims
database.default.username = root  
database.default.password =  
database.default.DBDriver = MySQLi  

#CI_ENVIRONMENT = development  
CI_ENVIRONMENT = production  
```

\app\Config\App.php  
```bash
public $baseURL = 'http://localhost/sims/public/';  
```
Sesuaikan
```bash
\app\Config\Constants.php  
```
Upload logo
\public\assets\gambar  
=> logo.jpg  

Pengaturan PDF
\vendor\tecnickcom\tcpdf\config\tcpdf_config.php  
```bash
define ('PDF_HEADER_LOGO', 'logo.jpg');  
define ('PDF_HEADER_LOGO_WIDTH', 15);  
define ('PDF_HEADER_TITLE', 'SMKN 2 Pandeglang');
```
