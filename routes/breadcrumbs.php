<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Sektor
Breadcrumbs::for('dashboard.sektor.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Sektor', route('dashboard.sektor.index'));
});

Breadcrumbs::for('dashboard.sektor.show', function (BreadcrumbTrail $trail, $sektor) {
    $trail->parent('dashboard.sektor.index');
    $trail->push('Detail', route('dashboard.sektor.show', $sektor));
});

Breadcrumbs::for('dashboard.sektor.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.sektor.index');
    $trail->push('Buat Sektor Baru', route('dashboard.sektor.create'));
});

Breadcrumbs::for('dashboard.sektor.edit', function (BreadcrumbTrail $trail, $sektor) {
    $trail->parent('dashboard.sektor.index', $sektor);
    $trail->push('Ubah Data Sektor', route('dashboard.sektor.edit', $sektor));
});

// Project
Breadcrumbs::for('dashboard.proyek.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Project', route('dashboard.proyek.index'));
});

Breadcrumbs::for('dashboard.proyek.show', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('dashboard.proyek.index');
    $trail->push('Detail', route('dashboard.proyek.show', $project));
});

Breadcrumbs::for('dashboard.proyek.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.proyek.index');
    $trail->push('Buat Project Baru', route('dashboard.proyek.create'));
});

Breadcrumbs::for('dashboard.proyek.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('dashboard.proyek.index', $project);
    $trail->push('Ubah Data Project', route('dashboard.proyek.edit', $project));
});

// Mitra
Breadcrumbs::for('dashboard.mitra.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Mitra', route('dashboard.mitra.index'));
});

Breadcrumbs::for('dashboard.mitra.show', function (BreadcrumbTrail $trail, $mitra) {
    $trail->parent('dashboard.mitra.index');
    $trail->push('Detail', route('dashboard.mitra.show', $mitra));
});

Breadcrumbs::for('dashboard.mitra.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.mitra.index');
    $trail->push('Buat Mitra Baru', route('dashboard.mitra.create'));
});

Breadcrumbs::for('dashboard.mitra.edit', function (BreadcrumbTrail $trail, $mitra) {
    $trail->parent('dashboard.mitra.index', $mitra);
    $trail->push('Ubah Data Mitra', route('dashboard.mitra.edit', $mitra));
});

// Kegiatan
Breadcrumbs::for('dashboard.kegiatan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Kegiatan', route('dashboard.kegiatan.index'));
});

Breadcrumbs::for('dashboard.kegiatan.show', function (BreadcrumbTrail $trail, $kegiatan) {
    $trail->parent('dashboard.kegiatan.index');
    $trail->push('Detail', route('dashboard.kegiatan.show', $kegiatan));
});

Breadcrumbs::for('dashboard.kegiatan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.kegiatan.index');
    $trail->push('Buat Kegiatan Baru', route('dashboard.kegiatan.create'));
});

Breadcrumbs::for('dashboard.kegiatan.edit', function (BreadcrumbTrail $trail, $kegiatan) {
    $trail->parent('dashboard.kegiatan.index', $kegiatan);
    $trail->push('Ubah Data Kegiatan', route('dashboard.kegiatan.edit', $kegiatan));
});

// Laporan
Breadcrumbs::for('dashboard.laporan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Laporan', route('dashboard.laporan.index'));
});

Breadcrumbs::for('dashboard.laporan.show', function (BreadcrumbTrail $trail, $laporan) {
    $trail->parent('dashboard.laporan.index');
    $trail->push('Detail', route('dashboard.laporan.show', $laporan));
});

Breadcrumbs::for('dashboard.laporan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.laporan.index');
    $trail->push('Buat Laporan Baru', route('dashboard.laporan.create'));
});

Breadcrumbs::for('dashboard.laporan.edit', function (BreadcrumbTrail $trail, $laporan) {
    $trail->parent('dashboard.laporan.index', $laporan);
    $trail->push('Ubah Data Laporan', route('dashboard.laporan.edit', $laporan));
});

?>
