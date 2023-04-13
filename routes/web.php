<?php

use App\Http\Controllers\AddonController;
use App\Http\Controllers\AdverseventController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


// Index page
Route::get('/', [PageController::class, 'home'])->name('index');

// Home page
Route::get('home', [PageController::class, 'home'])->name('home');

// Oznámení
Route::prefix('oznameni')->name('oznameni.')->group(function () {
    // Změny standardů
    Route::get('zmeny-standardu', [PageController::class, 'zmenyStandardu'])->name('zmeny-standardu');
    // Změny dokumentů
    Route::get('zmeny-v-dokumentaci', [PageController::class, 'zmenyDokumentu'])->name('zmeny-v-dokumentaci');
    // Důležitá oznámení
    Route::get('important/{id}', [PageController::class, 'oznameniFilter'])->name('important');
    // Odstávky a Servis
    Route::get('servis/{id}', [PageController::class, 'oznameniFilter'])->name('servis');
    // Služby
    Route::get('sluzby/{id}', [PageController::class, 'oznameniFilter'])->name('sluzby');
    // Semináře
    Route::get('seminare/{id}', [PageController::class, 'oznameniFilter'])->name('seminare');
    // Informace
    Route::get('informace/{id}', [PageController::class, 'oznameniFilter'])->name('informace');
    // Akord
    Route::get('akord/{id}', [PageController::class, 'oznameniFilter'])->name('akord');
    // Kultura
    Route::get('kultura/{id}', [PageController::class, 'oznameniFilter'])->name('kultura');
    // Normální
    Route::get('normalni/{id}', [PageController::class, 'oznameniFilter'])->name('normalni');
    // Dlouhodobá sdělení
    Route::get('dlouhodobe/{id}', [PageController::class, 'oznameniFilter'])->name('dlouhodobe');
});

// Stravování
Route::prefix('stravovani')->name('stravovani.')->group(function () {
    // Obědy
    Route::get('obedy', [PageController::class, 'obedy'])->name('obedy');
    // Kantýna
    Route::get('kantyna', [PageController::class, 'kantyna'])->name('kantyna');
    // Polévka
    Route::post('polevka/update/{id}', [PageController::class, 'changePolevka'])->name('kantyna.polevka.update');
    // Jídlo A
    Route::post('jidloa/update/{id}', [PageController::class, 'changeJidloA'])->name('kantyna.jidloa.update');
    // Jídlo B
    Route::post('jidlob/update/{id}', [PageController::class, 'changeJidloB'])->name('kantyna.jidlob.update');
    // Kantýna
    Route::post('kantyna/update/{id}', [PageController::class, 'changeKantyna'])->name('kantyna.kantyna.update');
});

// Dokumentace
Route::prefix('dokumenty')->name('dokumenty.')->group(function () {
    // Dokumentace personální
    Route::get('personalni/{id}', [PageController::class, 'document'])->name('personalni');
    // Dokumentace sesterská
    Route::get('sesterska/{id}', [PageController::class, 'document'])->name('sesterska');
    // Dokumentace hygienická
    Route::get('hygiena/{id}', [PageController::class, 'document'])->name('hygiena');
    // Dokumentace pacientská
    Route::get('pacient/{id}', [PageController::class, 'document'])->name('pacient');
    // Dokumentace OKB
    Route::get('okb/{id}', [PageController::class, 'document'])->name('okb');
    // Dokumentace RDG
    Route::get('rdg/{id}', [PageController::class, 'document'])->name('rdg');
    // Dokumentace IT
    Route::get('it/{id}', [PageController::class, 'document'])->name('it');
    // Dokumentace KPR
    Route::get('kpr/{id}', [PageController::class, 'document'])->name('kpr');
    // Dokumentace komunikační karty
    Route::get('komunikacni-karty/{id}', [PageController::class, 'document'])->name('komunikacni-karty');
    // Dokumentace vyhodnocení dotazníků
    Route::get('vyhodnoceni-dotazniku/{id}', [PageController::class, 'document'])->name('vyhodnoceni-dotazniku');
    // Dokumentace návody
    Route::get('navody/{id}', [PageController::class, 'document'])->name('navody');
});

// Standardy
Route::prefix('standardy')->name('standardy.')->group(function () {
    // Akreditační standardy
    Route::get('akreditacni/{id}', [PageController::class, 'akreditacni'])->name('akreditacni');
    // Ošetřovatelské standardy
    Route::get('osetrovatelske/{id}', [PageController::class, 'standard'])->name('osetrovatelske');
    // Léčebné standardy
    Route::get('lecebne/{id}', [PageController::class, 'standard'])->name('lecebne');
    // Speciální standardy
    Route::get('specialni/{id}', [PageController::class, 'standard'])->name('specialni');
    // Operační standardy
    Route::get('operacni/{id}', [PageController::class, 'standard'])->name('operacni');
    // Anesteziologické standardy
    Route::get('anesteziologicke/{id}', [PageController::class, 'standard'])->name('anesteziologicke');
    // RDG standardy
    Route::get('rdg/{id}', [PageController::class, 'standard'])->name('rdg');
    // Rehabilitační standardy
    Route::get('rehabilitacni/{id}', [PageController::class, 'standard'])->name('rehabilitacni');
    // OPL standardy
    Route::get('opl/{id}', [PageController::class, 'standard'])->name('opl');
    // OKB standardy
    Route::get('okb/{id}', [PageController::class, 'standard'])->name('okb');
    // Logopedické standardy
    Route::get('logopedicke/{id}', [PageController::class, 'standard'])->name('logopedicke');
    // Legislativní standardy
    Route::get('legislativni/{id}', [PageController::class, 'standard'])->name('legislativni');
    // Vyhledávání dokumentů
    Route::get('standard-search', [DocumentController::class, 'documentSearch'])->name('standard.search');
});

// BOZP - PO
Route::prefix('bozp')->name('bozp.')->group(function () {
    // Bezpečnostní plány
    Route::get('bezpecnostni-plany/{id}', [PageController::class, 'bozp'])->name('bezpecnostni-plany');
    // Organizační směrnice
    Route::get('organizacni-smernice/{id}', [PageController::class, 'bozp'])->name('organizacni-smernice');
    // Metodiky školení
    Route::get('metodiky-skoleni/{id}', [PageController::class, 'bozp'])->name('metodiky-skoleni');
    // Prezenční listiny
    Route::get('prezencni-listiny/{id}', [PageController::class, 'bozp'])->name('prezencni-listiny');
    // Pracovní úrazy
    Route::get('pracovni-urazy/{id}', [PageController::class, 'bozp'])->name('pracovni-urazy');
    // Bezpečnostní značení
    Route::get('bezpecnostni-znaceni/{id}', [PageController::class, 'bozp'])->name('bezpecnostni-znaceni');
    // Prověrky - kontroly
    Route::get('proverky-kontroly/{id}', [PageController::class, 'bozp'])->name('proverky-kontroly');
    // Provozně bezpečnostní předpisy
    Route::get('provozne-bezpecnostni-predpisy/{id}', [PageController::class, 'bozp'])->name('provozne-bezpecnostni-predpisy');
    // Rizika
    Route::get('rizika/{id}', [PageController::class, 'bozp'])->name('rizika');
    // Požární ochrana
    Route::get('pozarni-ochrana/{id}', [PageController::class, 'bozp'])->name('pozarni-ochrana');
    // Požární operativní karty
    Route::get('pozarni-operativni-karty/{id}', [PageController::class, 'bozp'])->name('pozarni-operativni-karty');
    // Bezpečnostní listy
    Route::get('bezpecnostni-listy/{id}', [PageController::class, 'bozp'])->name('bezpecnostni-listy');
});

// Rozpisy služeb
Route::prefix('rozpisy-sluzeb')->name('rozpisy-sluzeb.')->group(function () {
    Route::get('jip/{id}', [PageController::class, 'rozpisSluzeb'])->name('jip');
    Route::get('ortopedie/{id}', [PageController::class, 'rozpisSluzeb'])->name('ortopedie');
    Route::get('operacni-saly/{id}', [PageController::class, 'rozpisSluzeb'])->name('operacni-saly');
    Route::get('interna/{id}', [PageController::class, 'rozpisSluzeb'])->name('interna');
    Route::get('neurologie/{id}', [PageController::class, 'rozpisSluzeb'])->name('neurologie');
    Route::get('rdg/{id}', [PageController::class, 'rozpisSluzeb'])->name('rdg');
    Route::get('prijmova-ambulance/{id}', [PageController::class, 'rozpisSluzeb'])->name('prijmova-ambulance');
    Route::get('zurnalni-sluzby/{id}', [PageController::class, 'rozpisSluzeb'])->name('zurnalni-sluzby');
    Route::get('nutricni-terapeuti/{id}', [PageController::class, 'rozpisSluzeb'])->name('nutricni-terapeuti');
    Route::get('vsechna/{id}', [PageController::class, 'rozpisSluzeb'])->name('vsechna');
    Route::get('sluzby-tisk/{id}', [PageController::class, 'generate_pdf'])->name('sluzby-pdf');
});

// Indikátory kvality
Route::prefix('indikatory-kvality')->name('indikatory-kvality.')->group(function () {
    // Ankety
    Route::get('ankety/{id}', [PageController::class, 'indikatory'])->name('ankety');
    // Dekubity
    Route::get('dekubity/{id}', [PageController::class, 'indikatory'])->name('dekubity');
    // Nosokomiální nákazy
    Route::get('nosokomialni-nakazy/{id}', [PageController::class, 'indikatory'])->name('nosokomialni-nakazy');
    // Nežádoucí události
    Route::get('nezadouci-udalosti/{id}', [PageController::class, 'indikatory'])->name('nezadouci-udalosti');
    // Parametry kvality
    Route::get('parametry-kvality/{id}', [PageController::class, 'indikatory'])->name('parametry-kvality');
    // Formuláře
    Route::get('formulare/{id}', [PageController::class, 'indikatory'])->name('formulare');
});

// Zápisy z porad
Route::prefix('porady')->name('porady.')->group(function () {
    // Zápisy z porad primářů
    Route::get('primarske-porady/{id}', [PageController::class, 'porady'])->name('primarske-porady');
    // Zápisy z porad staničních sester
    Route::get('porady-stanicnich-sester/{id}', [PageController::class, 'porady'])->name('porady-stanicnich-sester');
});

// Řídící akty
Route::prefix('ridici-akty')->name('ridici-akty.')->group(function () {
    Route::get('prikazy/{id}', [PageController::class, 'acts'])->name('prikazy');
    Route::get('pokyny/{id}', [PageController::class, 'acts'])->name('pokyny');
    Route::get('smernice/{id}', [PageController::class, 'acts'])->name('smernice');
    Route::get('organizacni-rad/{id}', [PageController::class, 'acts'])->name('organizacni-rad');
    Route::get('provozni-rady/{id}', [PageController::class, 'acts'])->name('provozni-rady');
    Route::get('vnitrni-rad/{id}', [PageController::class, 'acts'])->name('vnitrni-rad');
});

// Akreditace
Route::prefix('akreditace')->name('akreditace.')->group(function () {
    Route::get('akreditace/{id}', [PageController::class, 'akreditace'])->name('akreditace');
    Route::get('auditni-protokoly-akr/{id}', [PageController::class, 'akreditace'])->name('aud-protokoly-akr');
    Route::get('auditni-protokoly-ose/{id}', [PageController::class, 'akreditace'])->name('aud-protokoly-ose');
    Route::get('vyhodnoceni-dotazniku/{id}', [PageController::class, 'akreditace'])->name('vyhodnoceni-dotazniku');
});

// Vyhledávání dokumentů
Route::get('dokument-search', [DocumentController::class, 'documentSearch'])->name('dokument.search');

// Download
Route::prefix('soubory')->name('soubory.')->group(function () {
    // Download dokumentu
    Route::get('dokument/{id}', [FileController::class, 'fileDownload'])->name('dokument.download');
    // Download standard addon
    Route::get('dokument/priloha/{id}', [FileController::class, 'documentAddonDownload'])->name('dokument.addon.download');
    // Download standardu
    Route::get('standard/{id}', [FileController::class, 'fileDownload'])->name('standard.download');
    // Download standardu addon
    Route::get('standard/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('standard.addon.download');
    // Download bozp
    Route::get('bozp/{id}', [FileController::class, 'fileDownload'])->name('bozp.download');
    // Download bozp addon
    Route::get('bozp/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('bozp.addon.download');
    // Download indikátory kvality
    Route::get('indikatory-kvality/{id}', [FileController::class, 'fileDownload'])->name('indikatory.download');
    // Download indikátory kvality addon
    Route::get('indikatory-kvality/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('indikatory.addon.download');
    // Download informované souhlasy
    Route::get('isp/{id}', [FileController::class, 'fileDownload'])->name('isp.download');
    // Download Education
    Route::get('edukace/{id}', [FileController::class, 'fileDownload'])->name('edukace.download');
    // Download Education addon
    Route::get('edukace/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('edukace.addon.download');
    // Download Porady
    Route::get('porada/{id}', [FileController::class, 'fileDownload'])->name('porada.download');
    // Download Porady addon
    Route::get('porada/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('porada.addon.download');
    // Download Řídící akty
    Route::get('ridici-akty/{id}', [FileController::class, 'fileDownload'])->name('ridici-akty.download');
    // Download Řídící akty addon
    Route::get('ridici-akty/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('ridici-akty.addon.download');
    // Download Řídící akty
    Route::get('akreditace/{id}', [FileController::class, 'fileDownload'])->name('akreditace.download');
    // Download Řídící akty addon
    Route::get('akreditace/priloha/{id}', [FileController::class, 'fileAddonDownload'])->name('akreditace.addon.download');
});

// Media links
Route::prefix('media')->name('media.')->group(function () {
    Route::get('radio', [PageController::class, 'radio'])->name('radio');
    Route::get('videa', [PageController::class, 'video'])->name('videa');
    Route::get('prekladatele', [PageController::class, 'prekladatele'])->name('prekladatele');
    Route::get('videa/lekis', [PageController::class, 'videoLekis'])->name('videa-lekis');
    Route::get('videa/bozp', [PageController::class, 'videoBozp'])->name('videa-bozp');
});

// Vide CRUD
Route::resource('video', VideoController::class);

// Edukace
Route::prefix('edukace')->name('edukace.')->group(function () {
    Route::get('edukacni-materialy/{id}', [PageController::class, 'edukace'])->name('edukacni-materialy');
    Route::get('distribuce/{id}', [PageController::class, 'edukace'])->name('distribuce');
    Route::get('navody/{id}', [PageController::class, 'edukace'])->name('navody');
});

// ISP
Route::get('isp', [PageController::class, 'isp'])->name('isp');

// ZV OS
Route::get('zvos', [PageController::class, 'zvos'])->name('zvos');

// Employees
Route::resource('employees', EmployeeController::class)->except(['update', 'show', 'destroy']);

// Adverse Events
Route::resource('adversevents', AdverseventController::class)->except(['update', 'show', 'destroy']);

// Notification
Route::resource('notifications', NotificationController::class)->except(['update', 'show', 'destroy']);

// Documents
Route::resource('documents', DocumentController::class)->except(['update', 'destroy']);
Route::resource('documents/addons', AddonController::class)->except(['update', 'destroy']);

// VCards
Route::get('vcards', [EmployeeController::class, 'vcards'])->name('employees.vcards');
Route::get('search', [EmployeeController::class, 'vcardSearch'])->name('employees.search');

Route::post('sluzby/jip/update/{id}', [PageController::class, 'changeDoctorJip'])->name('sluzby.jip.update');
Route::post('sluzby/ortopedie/update/{id}', [PageController::class, 'changeDoctorOrtopedie'])->name('sluzby.ortopedie.update');
Route::post('sluzby/operacni-saly/update/{id}', [PageController::class, 'changeDoctorOperacniSaly'])->name('sluzby.operacni-saly.update');
Route::post('sluzby/interna/update/{id}', [PageController::class, 'changeDoctorInterna'])->name('sluzby.interna.update');
Route::post('sluzby/neurologie/update/{id}', [PageController::class, 'changeDoctorNeurologie'])->name('sluzby.neurologie.update');
Route::post('sluzby/zurnal/update/{id}', [PageController::class, 'changeDoctorZurnal'])->name('sluzby.zurnal.update');
Route::post('sluzby/rdg/update/{id}', [PageController::class, 'changeDoctorRdg'])->name('sluzby.rdg.update');
Route::post('sluzby/prijmovka/update/{id}', [PageController::class, 'changePrijmovkaSestra'])->name('sluzby.prijmovka.update');
Route::post('sluzby/nutricni/update/{id}', [PageController::class, 'changeNutricni'])->name('sluzby.nutricni.update');

// Auth Routes
Route::group(['middleware' => 'auth'], function () {
    // Employee
    Route::post('employee/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('employee/destroy-photo/{id}', [EmployeeController::class, 'destroyPhoto'])->name('employee.photo');
    Route::get('export', [EmployeeController::class, 'exportTable'])->name('employees.export');
    Route::get('phonelist', [EmployeeController::class, 'exportPhoneList'])->name('employees.phonelist');
    Route::get('list', [EmployeeController::class, 'exportList'])->name('employees.list');

    // Adverse Events
    Route::post('adversevent/update', [AdverseventController::class, 'update'])->name('adversevent.update');
    Route::get('adversevent/destroy/{id}', [AdverseventController::class, 'destroy'])->name('adversevent.destroy');

    // Notifications
    Route::post('notifications/update', [NotificationController::class, 'update'])->name('notification.update');
    Route::get('notifications/destroy/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');

    // Document Events
    Route::post('documents/update', [DocumentController::class, 'update'])->name('documents.update');
    Route::post('documents/sklad', [DocumentController::class, 'sklad'])->name('documents.sklad');
    Route::get('documents/destroy/{id}', [DocumentController::class, 'destroy']);

    // Document Events
    Route::post('documents/addons/update', [AddonController::class, 'update'])->name('addons.update');
    Route::get('documents/addons/destroy/{id}', [AddonController::class, 'destroy']);

    // Paint Events
    Route::post('paints/update', [PaintController::class, 'update'])->name('paint.update');
    Route::get('paints/destroy/{id}', [PaintController::class, 'destroy']);

    // Paint Events
    Route::resource('paints', PaintController::class)->except(['update', 'show', 'destroy']);

    Route::get('user/profile', [PageController::class, 'profile'])->name('user.profile');
});
