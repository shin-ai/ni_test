<style>
    .content {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="container d-flex flex-column align-items-center">
    <h1 class="mt-4">About Me!</h1>
    <img src="<?= BASEURL; ?>/img/patung.jpg" alt="Error" width="150" height="150" class="rounded-circle">
    <div class=" mt-3 text-center">
        <p>Halo, Nama saya <?= $data['nama']; ?>, umur saya <?= $data['umur']; ?></p>
        <p>Hobi saya adalah <?= $data['hobi']; ?>.</p>
    </div>
</div>