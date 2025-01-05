<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin-panel.css">
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="#approve-products">Approve Products</a></li>
                    <li><a href="#approve-pickups">Approve Pickups</a></li>
                    <li><a href="#approve-users">Approve Users</a></li>
                </ul>
            </nav>
        </aside>
        <div class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>
            <section id="approve-products">
                <h2>Approve Uploaded Products</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Upload Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            <tr>
                                <td>1</td>
                                <td>Example Product</td>
                                <td>2024-07-26</td>
                                <td>
                                    <button class="approve-btn">Approve</button>
                                    <button class="reject-btn">Reject</button>
                                </td>
                            </tr>
                            <!-- More rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="approve-pickups">
                <h2>Approve Pickup Requests</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Pickup Location</th>
                                <th>Pickup Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            <tr>
                                <td>1</td>
                                <td>Location A</td>
                                <td>2024-07-27</td>
                                <td>
                                    <button class="approve-btn">Approve</button>
                                    <button class="reject-btn">Reject</button>
                                </td>
                            </tr>
                            <!-- More rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="approve-users">
                <h2>Approve User Registrations</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            <tr>
                                <td>1</td>
                                <td>JohnDoe</td>
                                <td>johndoe@example.com</td>
                                <td>
                                    <button class="approve-btn">Approve</button>
                                    <button class="reject-btn">Reject</button>
                                </td>
                            </tr>
                            <!-- More rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
