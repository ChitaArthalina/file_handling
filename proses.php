<?php

if (isset($_POST['submit'])) {
    $inputFile = $_POST['inputFile'];
    $tagLama = strtolower(trim($_POST['tagLama']));
    $tagBaru = strtolower(trim($_POST['tagBaru']));
    $tipeOutput = strtoupper(trim($_POST['tipeOutput']));

    if (!file_exists($inputFile)) {
        echo "<p style='color:red;'>File tidak ditemukan: $inputFile</p>";
        exit;
    }

    // Ambil isi file
    $content = file_get_contents($inputFile); //coba.html dibaca sebagai teks doang

    // Ganti tag pembuka dan penutup
    $content = str_replace("<$tagLama", "<$tagBaru", $content);
    $content = str_replace("</$tagLama>", "</$tagBaru>", $content);

    // Tentukan nama file keluaran
    if ($tipeOutput === "O") {
        file_put_contents($inputFile, $content);
        echo "<p style='color:green;'>Tag berhasil diubah. Perubahan telah disimpan ke file asli: $inputFile</p>";
    } elseif ($tipeOutput === "N") {
        $newFile = preg_replace('/\.html$/i', '-new.html', $inputFile);
        file_put_contents($newFile, $content);
        echo "<p style='color:green;'>Tag berhasil diubah. Perubahan telah disimpan ke file baru: $newFile/p>";
    } else {
        echo "<p style='color:red;'>Input tidak valid. Gunakan 'O' untuk file asli atau 'N' untuk file baru</p>";
    }
}

?>