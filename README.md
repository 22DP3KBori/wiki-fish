🎣 Makšķernieka Forums
Makšķernieka Forums ir tīmekļa foruma projekts, kas veltīts makšķerēšanas entuziastiem. Lietotāji var apspriest dažādas tēmas, dalīties ar komentāriem, pievienot rekordu informāciju par noķertajām zivīm, kā arī mainīt profila iestatījumus.

🔧 Funkcionalitāte
✅ Reģistrācija un autorizācija (ar paroļu atkopšanu)
✅ Lomu sistēma (admin, user)
✅ Tēmas un apakštēmas veidošana, dzēšana
✅ Komentāru (ziņojumu) rakstīšana ar rediģēšanu un dzēšanu
✅ Lietotāja profila rediģēšana un avatara maiņa
✅ Izlases (favorītu) tēmu pievienošana
✅ Zivju rekordu tabula (pieejama admin)
✅ Meklēšana pa tēmu nosaukumiem, apakštēmām, komentāriem un autoriem
✅ Tumšais/gaišais režīms (maināms ar pogu)
✅ Dizains optimizēts un sadalīts komponentēs (kopīgs navbar, footer, style.css)
✅ Aizsardzība pret piekļuvi bez autorizācijas

📁 Struktūra
student/
│
├── css/
│   ├── style.css              # Kopējais stils
│   ├── dark.css               # Tumšās tēmas stils
│   └── custom_style.css
│
├── html/
│   ├── main.php               # Sākumlapa
│   ├── topic.php              # Tēmu saraksts
│   ├── subtopics.php          # Apakštēmas vienai tēmai
│   ├── messages.php           # Komentāri vienai apakštēmai
│   ├── register.php
│   ├── login.php
│   ├── forgot_password.php
│   ├── verify_code.php
│   ├── confirm_password.php
│   ├── profile_settings.php
│   ├── record.php             # Zivju rekordi
│   └── search.php             # Meklēšana
│
├── include/
│   ├── db.php                 # Savienojums ar MySQL
│   ├── navbar.php             # Kopīgs navigācijas panelis
│   ├── footer.php             # Kopīgs kājenes fails
│   ├── logout.php
│   ├── login.php              # Apstrāde
│   ├── register_user.php
│   ├── update_profile.php
│   ├── create_message.php
│   ├── delete_message.php
│   └── ...
│
├── uploads/avatars/           # Lietotāju avatari
├── phpmailer/                 # PHPMailer bibliotēka
├── js/
│   └── theme.js               # Tumšās tēmas pārslēgšana
└── README.md                  # Projekta apraksts

⚙️ Tehnoloģijas
PHP (bez freima)
MySQL (ar mysqli un JOIN)
HTML/CSS/JS
PHPMailer – e-pasta nosūtīšana (paroles atjaunošanai)
Font Awesome – ikonas
Bootstrap-inspirēts dizains – pielāgots

🔐 Lomu Sistēma
admin – var dzēst tēmas/apakštēmas, pievienot rekordu
user – var komentēt, mainīt profilu
Neregistrēts lietotājs nevar skatīt/komentēt apakštēmas

💡 Lietošana
Klonē/lejupielādē projektu.
Pārliecinies, ka ir uzstādīts OSPanel/XAMPP un ieslēgts MySQL + Apache.
Importē SQL datni makskernieki.sql savā datubāzē.
Atver http://localhost/student/html/main.php pārlūkā.
Izmēģini reģistrāciju, paroles atkopšanu, komentārus u.c.

📌 Piezīmes
PHPMailer nepieciešama Google App parole e-pasta sūtīšanai.
Visām lapām izmantots viens navbar un footer.

📫 Kontakti
Projekts veidots mācību vajadzībām.
Autors: Kirills Borisovs
Tehnikums: RVT
Gads: 2025