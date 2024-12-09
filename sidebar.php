<div class="d-flex flex-column p-3 bg-dark" style="height: 100vh; width: 250px; position: fixed; top: 0; left: 0;">
    <h4 class="text-center">My Restaurant</h4>
    <h4 class="text-center">My Restaurant</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="home">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>

        <?php if ($records['level'] == 1) : ?>
            <li class="nav-item">
                <a class="nav-link" href="menu">
                    <i class="bi bi-cart4"></i> Daftar Menu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="katmenu">
                    <i class="bi bi-tags"></i> Kategori Menu
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link" href="order">
                <i class="bi bi-cart4"></i> Order
            </a>
        </li>

        <?php if ($records['level'] == 1) : ?>
            <li class="nav-item">
                <a class="nav-link" href="user">
                    <i class="bi bi-grid-fill"></i> User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report">
                    <i class="bi bi-file-earmark-zip-fill"></i> Report
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
