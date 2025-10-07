<?php
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Sanitize and convert to integer
    // Fetch product details using $product_id
    $sql = "SELECT * from products where Pid=$product_id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {

        $productId = urlencode($row['Pid']);
        $photo = htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8');
        $qty = htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8');
        $description= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');
   
        echo "<form action='update.php?id=$productId' method='post' enctype='multipart/form-data'>";

        echo "<label for='name'>Product Name:</label>";
        echo "<input type='text' id='pname' name='pname' value='$name' ><br><br>";
        
        echo "<label for='category'>Category:</label>
        <select id='category' name='category' required>
            <option value='Mobile'>Mobile</option>
            <option value='Tablet'>Tablet</option>
            <option value='Ac'>A.C</option>
            <option value='Fridge'>Fridge</option>
            <option value='Tv'>Television</option>
            <option value='Washing machine'>Washing machine</option>
            <!-- Add more categories as needed -->
        </select><br><br>";

        echo "<label for='price'>Price:</label>";
        echo "<input type='number' value='$price' id='price' name='price' step='0.01' required><br><br>";

        echo "<label for='quantity'>Quantity:</label>";
        echo "<input type='number' id='quantity' value='$qty' name='quantity' required><br><br>";

        echo "<label for='description'>Description:</label><br>";
        echo "<textarea id='description' name='description' rows='4' cols='50'>$description</textarea><br><br>";

        echo "<label for='photo'>Photo:</label>";
        echo "<input type='file' id='photo' name='photo' accept='image/*'><br><br>";

        echo "<input type='submit' value='Update'>";
        echo "</form>";

    }
}
