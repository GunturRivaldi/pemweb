09:00-12:00

Materi Pertemuan 1 

A. Membuat 2 File dan 1 Folder 
Folder : Coding
File : analisa.md dan catatan.md

B. Cara menghungkan Docker dan HTML

1. Membuat File .env didalam folder coding

COMPOSE_PROJECT_NAME= esgul // Bagian ini untuk nentuin nama projek docker compose
REPOSITORY_NAME= esgul      // Untuk menentukan repository untuk image docker
IMAGE_TAG=latest            // Menggunakan tag untuk image docker, "latest" disini berarti kita menggunakan versi terbaru.

2. Membuat File docker.compose.yml didalam folder Coding dengan konfigurasi sebagai berikut

version: '3' // versi terbaru dari docker

services:                    // services dipakai buat nentuin service (layanan) yang akan berjalan dalam Docker Compose, biasanya bisa 1 atau lebih.
  web:                       // ini nama salah satu layanan yang sedang digunakan, dalam hal ini diberi nama web.
  image: nginx:latest:       // image dipakai untuk menggunakan image Docker dari Nginx dengan versi latest.
  ports:                     // dipakai untuk memetakan port yang akan digunakan pada server. 
   - 80:80
   volumes: 
    - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf 
    - ./src/index.html:/usr/share/nginx.html // volume dipakai untuk menyambungkan file konfigurasi lokal (./nginx/nginx.conf) ke dalam container pada path /etc/nginx/conf.d/default.conf. Hal ini memungkinkan penggunaan konfigurasi Nginx yang sudah disesuaikan tanpa mengubah file di dalam container.

3. Membuat File nginx.conf didalam folder "coding"
nginx.conf 

server {                            // Mendeklarasikan blok server yang akan menangani permintaan HTTP.
    listen 80;                      // Menentukan bahwa server akan mendengarkan di port 80, yang merupakan port default untuk HTTP.
    server_name localhost;          // nama server web yang kita tentuin, Ini berarti server akan merespons permintaan yang dikirim ke localhost.

    location / {                     // Mendefinisikan lokasi untuk root (/), yang berarti aturan dalam blok ini berlaku untuk semua permintaan ke domain utama.
        root / usr/share/nginx/html; // Menentukan direktori root tempat file HTML akan diambil, yaitu /usr/share/nginx/html.
        index index.html             // Menentukan file default yang akan ditampilkan jika pengguna mengakses root (/) tanpa menentukan file tertentu.
    }
}

port pada web server menggunakan 80 agar mudah diperiksa, tapi nanti di forward ke layar depan (OS) yang nantinya bisa memakai port lain 
contoh : port 81, 82, dst.

html

<!DOCTYPE html>         // ini merupakan deklarasi tipe dokumen HTML untuk memberi tahu browser bahwa ini adalah dokumen HTML5.
<html lang="en">        // Membuka elemen <html> yang merupakan root dari semua elemen dalam dokumen HTML. lang="en" → Menentukan bahwa bahasa utama halaman ini adalah Inggris (en).
<head>                  // Membuka elemen <head>, yang berisi informasi metadata untuk halaman web.
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title> // ini adalah judul halaman yang akan ditampilkan pada tab browser.
</head>
<body>                  // Body adalah tempat untuk mengisi konten dari web yang artinya semua konten dari web diisi disini
    <div>               // Elemen div dipakai untuk mengelompokkan elemen-elemen lain
        This is a div element.
        <p>This is a paragraph inside the div.</p>  // Elemen p dipakai untuk memberi paragraf teks pada halaman
    </div>
</body>
</html>


Note: Setiap elemen selalu memilik pembuka dan penutup yang biasanya punya "/" pada elemen penutupnya,
      semisal = "<div>" sebagai pembuka, lalu </div> sebagai penutup


13:00-15:30

Materi HTML 
HTML 

HTML sendiri merupakan singkatan dari "HyperText Markup Languange" yang berarti HTML merupakan bahasa penanda (Markup) dan memiliki banyak perintah untuk membangun sebuah website, HTML ini bisa dibilang bahasa paling dasar yang digunakan untuk mengembangkan sebuah web.
Kita menggunakan HTML karena ini merupakan pondasi untuk membangun sebuah website, HTML sendiri mudah dipelajari dan bisa dibilang fleksibel, karena mudah dikombinasikan dengan CSS dan Javascript.
HTML biasanya mulai digunakan untuk membangun sebuah website dan juga aplikasi web.
HTML bisa dipakai di semua halaman web, pada perangkat keras yang mudah dibawa kemana-mana seperti laptop, dan bisa juga di PC
HTML biasanya digunakan oleh Web Developer, Mahasiswa, UI/UX Designer
Untuk mengoperasikan HTML, kita bisa memulai dengan mengetik "HTML:5" di VSCode, angka "5" sendiri merupakan versi terbarukan dari HTML
didalamnya kita bisa menggtur judul pada bagian <title>, dan kita mulai membangun website dengan mengisi seluruh konten didalam <body>.

Beberapa tag dasar didalam HTML yaitu:
tag "a" : Digunakan untuk memberi hyperlink pada sebuah text
tag "div" : Digunakan untuk mengelompokkan elemen-elemen yang ingin dikerjakan
tag "p" : Digunakan untuk membuat paragraf text baru 
tag "ul" : Digunakan untuk memberi Unordered list yaitu list yang tidak bernomor atau berurutan, ini ada temannya yaitu "ol" berupa list yang menggunakan simbol-simbol seperti lingkaran, kotak, dll.
tag "img" : Digunakan untuk menambahkan gambar pada sebuah halaman
tag "h" : Digunakan untuk mengatur header atau sebagai judul pada sebuah halaman

15:30-18:00

Pada jam ini kita mengerjakan sebuah projek yaitu membuat halaman Home.html dan profile.html, untuk menambahkan ini kita membuat folder baru bernama "latihan" sebagai pemisah dan tempat pengerjaannya, jika sudah kita buat kedua file tadi, dan lakukan beberapa configurasi baru pada file docker-compose.yml dan file nginx.conf, didalamnya yaitu 

docker-compose.yml penambahan lokasi file pada volume menjadi =
    volumes:
      - ./src:/usr/share/nginx/html
      - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf
      - ./latihan:/usr/share/nginx/html/latihan

nginx.conf penambahan lokasi file untuk folder latihan menjadi =
        location /latihan {
            alias /usr/share/nginx/html/latihan;
            index index.html index.htm home.html;
            try_files $uri $uri.html $uri/ =404;
        }
 }

Jika sudah kita matikan docker dengan mengetik "docker-compose down" pada Ubuntu, tunggu beberapa saat, setelah itu aktifkan kembali docker dengan mengetik "docker compose up -d --build", lalu mulai mengerjakan projek


