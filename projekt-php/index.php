<?php 
require 'db.php'; 

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT p.*, w.id as is_favorite 
        FROM products p 
        LEFT JOIN wishlist w ON p.id = w.product_id";

if ($search !== '') {
    $sql .= " WHERE p.name LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $stmt = $pdo->query($sql);
}

$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sklep</title>
    <script src="https://cdn.tailwindcss.com"></script> </head>
    
<body class="bg-gray-100 p-10">
    
    <h1 class="text-3xl font-bold mb-6 text-center">Nasze Produkty</h1>
    
    <form method="GET" action="index.php" class="mb-8 flex gap-2 justify-center">
        <input 
            type="text" 
            name="search" 
            placeholder="Szukaj produktu..." 
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
            class="border p-2 rounded w-64 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition">
            Szukaj
        </button>
        <a href="index.php" class="bg-gray-300 px-4 py-2 rounded flex items-center hover:bg-gray-400">Wyczyść</a>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($products as $product): ?>
            <?php 
                $is_fav = !empty($product['is_favorite']);
                
                $button_classes = $is_fav 
                    ? 'bg-red-500 text-white border-red-500' 
                    : 'text-red-500 border-red-500 hover:bg-red-50';
                
                $button_text = $is_fav ? 'Polubiono!' : 'Dodaj do ulubionych';
            ?>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="text-green-600 font-bold text-lg"><?php echo $product['price']; ?> zł</p>
                <p class="text-gray-500 text-sm">Stan: <?php echo $product['stock']; ?> szt.</p>
                
                <button 
                    class="wishlist-btn mt-4 border-2 px-4 py-2 rounded transition-colors <?php echo $button_classes; ?>"
                    data-id="<?php echo $product['id']; ?>"
                >
                    ❤️ <span class="btn-text"><?php echo $button_text; ?></span>
                </button>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
    document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const btnText = this.querySelector('.btn-text');

            fetch('add_to_wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ productId: productId })
            })
            .then(response => response.json())
            .then(data => {
                this.classList.toggle('bg-red-500');
                this.classList.toggle('text-white');
                btnText.innerText = (data.status === 'added') ? 'Polubiono!' : 'Dodaj do ulubionych';
            });
        });
    });
    </script>
</body>
</html>