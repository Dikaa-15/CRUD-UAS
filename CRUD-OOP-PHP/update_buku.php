<?php
require_once './Database.php';
require_once './Buku.php';

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];  // Get the 'id' parameter from the URL
    $book = $buku->getById($id_buku);  // Get book details by id_buku
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $jumlah_halaman = $_POST['jumlah_halaman'];
    $stok = $_POST['stok'];
    $sinopsis = $_POST['sinopsis'];

    // Update book details
    if ($buku->update($id_buku, $judul, $penulis, $penerbit, $jumlah_halaman, $stok, $sinopsis)) {
        header("Location: ./index.php");
        exit();
    } else {
        echo "Gagal memperbarui data buku";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center mt-3">Update Buku</h1>
    <div class="container">
        <form action="./update_buku.php?id=<?= $id_buku ?>" method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" required value="<?= $book['judul'] ?>">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required value="<?= $book['penulis'] ?>">
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" required value="<?= $book['penerbit'] ?>">
            </div>
            <div class="mb-3">
                <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" required value="<?= $book['jumlah_halaman'] ?>">
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required value="<?= $book['stok'] ?>">
            </div>
            <div class="mb-3">
                <label for="sinopsis" class="form-label">Sinopsis Buku</label>
                <textarea class="form-control" id="sinopsis" name="sinopsis" required><?= $book['sinopsis'] ?></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Buku</button>
            </div>
        </form>
    </div>
</body>

</html>
