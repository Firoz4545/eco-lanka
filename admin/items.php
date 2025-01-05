?>
                </tbody>
            </table>
        </div>

        <div class="container">
            <h2 class="my-4">Product Details</h2>
            <table class="table container">
                <thead class="py-4">
                    <tr>
                        <th scope="col">Product Id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to the products database
                    $query = 'SELECT * FROM `products`'; // Assuming the table name is 'products'
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr><th>" . $row['id'] . "</th>";
                        echo "<th>" . $row['name'] . "</th>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['stock'] . "</td>";
                        echo "<td>
                                <a href='scripts/delete_product.php?id={$row['id']}'><button type='button' class='btn btn-danger'>Delete</button></a>
                            </td></tr>";
                    }