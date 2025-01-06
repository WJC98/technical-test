<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(229, 239, 248);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .event-card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .event-card:hover {
            transform: translateY(-10px);
        }

        .register-btn {
            border-radius: 50px;
            padding: 12px 32px;
            background-color: #3498db; 
            color: white;
            font-weight: bold;
        }

        .register-btn:hover {
            background-color: #2980b9; 
        }

        .list-group-item {
            border-radius: 10px;
            margin-bottom: 10px;
            background-color: #fff;
        }

        .container {
            flex: 1;
        }

        .event-header {
            font-size: 3rem; 
            font-weight: bold; 
            text-align: center; 
            color: #3498db; 
            margin-bottom: 15px; 
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .modal-header {
            border-bottom: 2px solid #ddd;
            background-color: #f8f9fa;
        }

        .modal-body {
            padding: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #6c5ce7; 
            box-shadow: 0 0 8px rgba(108, 92, 231, 0.4); 
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-top: 2px solid #ddd;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #3498db; 
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            padding: 12px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #2980b9; 
        }

        .alert-custom {
            background-color: #e7f5ff;
            color: #3498db;
        }

        .table {
            border-collapse: separate; 
            border-spacing: 0 10px; 
        }

        .table-striped tbody tr {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        .table-striped tbody tr:hover {
            transform: translateY(-5px); 
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); 
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table thead th {
            font-weight: bold;
            padding: 12px;
            text-align: center;
            border-radius: 10px;
        }

        .table td {
            text-align: center; 
            padding: 15px;
            vertical-align: middle;
        }

        .table td .register-btn {
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 1rem;
        }

        .table td .btn-secondary {
            background-color: #e0e0e0; 
            color: #9e9e9e; 
            cursor: not-allowed; 
        }

        #searchQuery {
            border-radius: 50px;
            padding: 12px;
            width: 60%;
            margin-bottom: 10px;
            display: block;
            border: 1px solid #ccc;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        #searchQuery:focus {
            border-color: #007bff;
            outline: none;
        }

        .pagination {
            justify-content: center;
            padding-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-item .page-link {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 8px 16px;
            font-size: 1rem;
        }

        .pagination .page-item .page-link:hover {
            background-color: #0056b3;
        }

        .pagination .active .page-link {
            background-color: #0056b3;
            border-color: #0056b3;
        }
            
        #eventsList .table {
            font-family: 'Roboto', Arial, sans-serif; 
            font-size: 1rem; 
            color: #2c3e50;
            margin-top: 0; 
    		margin-bottom: 20px; 
        }

        #eventsList .table thead th {
            font-weight: bold; 
            font-size: 1.1rem; 
            color: #ffffff; 
            background-color: #007bff; 
            text-transform: uppercase; 
        }

        #eventsList .table tbody td {
            font-size: 0.95rem; 
            color: #555555; 
            font-weight: 400; 
        }

        #eventsList .table tbody tr:hover td {
            background-color: #f4f7fa; 
            color: #000000; 
        }

        #eventsList .table {
            border-radius: 8px;
            overflow: hidden;
        }

        #eventsList .table tbody td .btn {
            font-size: 0.9rem; 
            padding: 6px 12px; 
            text-transform: uppercase; 
        }

        .header {
            background: linear-gradient(90deg, #3498db, #8e44ad); 
            padding: 12px 20px;
            color: white;
            border-radius: 10px;
        }

        .header .logo {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .header .btn-login {
        background: linear-gradient(90deg, #3498db, #8e44ad); 
        color: white;
        border: none;
        font-size: 1.1rem;
        padding: 12px 30px;
        border-radius: 50px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        }

        .header .btn-login:hover {
            background: linear-gradient(90deg, #8e44ad, #3498db); 
            transform: translateY(-5px); 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
        }

        .header .btn-login:focus {
            outline: none;
        }

        #registeredEventsList .list-group-item {
            border-radius: 12px; 
            margin-bottom: 10px; 
            background-color: #ffffff; 
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); 
            padding: 20px; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        #registeredEventsList .list-group-item:hover {
            transform: translateY(-5px); 
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); 
        }

        #registeredEventsList .list-group-item h5 {
            font-size: 1.25rem; 
            font-weight: bold;
            color: #007bff; 
        }

        #registeredEventsList .list-group-item p {
            font-size: 1rem;
            color: #555555; 
        }

        #registeredEventsList .list-group-item small {
            font-size: 0.875rem; 
            color: #888888; 
            display: block; 
            margin-top: 10px; 
        }            

        .footer {
            background: linear-gradient(90deg, #3498db, #8e44ad); 
            color: white;
            text-align: center;
            padding: 12px;
            margin-top: auto;
            width: 100%;
            border-radius: 10px;
        }

        @media (max-width: 576px) {
            .event-header {
                font-size: 2rem;
            }

            .container {
                padding-left: 10px;
                padding-right: 10px;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .header .logo {
                font-size: 1.4rem;
            }

            .header .btn-login {
            font-size: 1rem; 
            padding: 10px 25px; 
            }

            .table td {
                font-size: 0.9rem;
                padding: 10px;
            }

            .table thead th {
                padding: 10px;
            }

            .pagination {
                display: flex;
                justify-content: center;
                padding-top: 15px;
            }

            #searchQuery {
                width: 80%;
                font-size: 1rem;
            }              

            .table td .register-btn {
                font-size: 0.9rem;
                padding: 8px 20px;
            }

            .modal-dialog {
            max-width: 90%;
            }
                
            .modal-body {
                padding: 15px;
            }
                

            #registeredEventsList .list-group-item {
                padding: 15px; 
            }

            #registeredEventsList .list-group-item h5 {
                font-size: 1.1rem; 
            }

            #registeredEventsList .list-group-item p {
                font-size: 0.9rem; 
            }

            #registeredEventsList .list-group-item small {
                font-size: 0.8rem;
            }

            .footer {
                font-size: 0.9rem; 
            }
        }
    </style>

</head>
<body>
    <header class="header d-flex justify-content-between align-items-center">
        <div class="logo">
            <span id="event-management-btn">
            	<i class="fas fa-calendar-alt"></i> Event Management
        	</span>
        </div>
        <a href="admin_login.php" class="btn btn-login">
            <i class="fas fa-user"></i> Admin Login
        </a>
    </header>

    <div class="container my-4">
        <h1 class="text-center mb-4 text-primary event-header">Available Events</h1>
        
        <div class="d-flex justify-content-center mb-4">
            <input type="text" id="searchQuery" class="form-control" placeholder="Search events by name or location">
        </div>

        <div id="eventsList" class="mb-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Capacity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="eventTableBody">
                    </tbody>
                </table>
            </div>
            <nav id="paginationNav" aria-label="Page navigation">
                <ul class="pagination">
                </ul>
            </nav>
        </div>

        <div id="registeredEvents">
            <h3 class="text-center mb-4">View Your Registered Events</h3>
            <form id="registeredForm" class="d-flex justify-content-center mb-4">
                <input type="email" id="userEmail" class="form-control me-2 w-50" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">View</button>
            </form>
            <div id="registeredEventsList" class="list-group"></div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register for Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm">
                        <input type="hidden" id="eventId">

                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" required placeholder="Enter your name">
                        </div>

                        <div class="mb-3">
                            <label for="userEmailModal" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmailModal" required placeholder="Enter your email">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; CWJ Technical Test 2025</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
        let currentPage = 1;  
        let currentQuery = ""; 

        // Function to load events with pagination
        function loadEvents(page = 1, searchQuery = "") {
            $.get(`get_all_events.php?page=${page}&limit=5&search=${searchQuery}`, function (response) {
                const data = JSON.parse(response);
                const events = data.events;
                const totalPages = data.totalPages;
                const currentPage = data.currentPage;
              
                $('#eventTableBody').empty();
                $('#paginationNav .pagination').empty();

                if (events.length > 0) {              
                    events.forEach(event => {
                        const capacity = parseInt(event.capacity, 10);
                        let remainingSlots = parseInt(event.remaining_slots, 10);
                        const isFullyBooked = remainingSlots <= 0;

                        if (isNaN(remainingSlots)) {
                            remainingSlots = 0;
                        }

                        const registerButton = isFullyBooked 
                            ? '<button class="btn btn-secondary" disabled>Fully Booked</button>' 
                            : `<button class="btn btn-primary register-btn" data-id="${event.id}" data-name="${event.name}" data-capacity="${event.capacity}" data-remaining_slots="${event.remaining_slots}">Register</button>`;

                        const eventRow = `
                            <tr data-event-id="${event.id}">
                                <td>${event.name}</td>
                                <td>${event.description}</td>
                                <td>${event.event_date}</td>
                                <td>${event.location}</td>
                                <td class="remaining-slots">${remainingSlots} / ${capacity}</td>
                                <td>${registerButton}</td>
                            </tr>
                        `;
                        $('#eventTableBody').append(eventRow);
                    });

                    for (let i = 1; i <= totalPages; i++) {
                        const activeClass = (i === currentPage) ? 'active' : '';
                        const pageButton = `<li class="page-item ${activeClass}">
                                                <a class="page-link" href="javascript:void(0);" data-page="${i}" data-query="${searchQuery}">${i}</a>
                                            </li>`;
                        $('#paginationNav .pagination').append(pageButton);
                    }
                } else {
                    $('#eventTableBody').append('<tr><td colspan="6" class="text-center">No available events found.</td></tr>');
                }
            });
        }

        loadEvents();
         
        // Reload page        
        document.getElementById("event-management-btn").addEventListener("click", function(event) {
            event.preventDefault();
            window.location.href = "index.php";  
        });

        // Handle search input
        $('#searchQuery').on('input', function () {
            const searchQuery = $(this).val();
            loadEvents(1, searchQuery); 
        });

        // Handle pagination click
        $(document).on('click', '.page-link', function () {
            currentPage = $(this).data('page');
            currentQuery = $(this).data('query') || currentQuery;
            loadEvents(currentPage, currentQuery); 
            
            $('#registeredEventsList').hide();
        });

        // Show registration modal
        $(document).on('click', '.register-btn', function () {
            const eventId = $(this).data('id');
            const eventName = $(this).data('name');
            const eventCapacity = $(this).data('capacity');
            const eventRemainingSlots = $(this).data('remaining_slots');

            if (eventRemainingSlots <= 0) {
                alert('This event is fully booked.');
                return;
            }

            $('#eventId').val(eventId);
            $('#eventName').text(eventName); 
            $('#registerModal').modal('show');
            $('#registeredEventsList').hide();
        });

        // Handle registration form submission
        $('#registrationForm').submit(function (e) {
            e.preventDefault();
            const formData = {
                eventId: $('#eventId').val(),
                name: $('#userName').val(),
                email: $('#userEmailModal').val(),
            };

            $.post('register_event.php', formData, function (response) {
                const feedback = JSON.parse(response);
                alert(feedback.message);

                if (feedback.message === 'Registration successful.') {
                    const eventId = $('#eventId').val();
                    const row = $(`tr[data-event-id="${eventId}"]`);
                    const capacity = parseInt(row.find('td').eq(4).text().split(' / ')[1], 10); 
                    let remainingSlots = parseInt(row.find('td').eq(4).text().split(' / ')[0], 10); 

                    remainingSlots--;
                    const updatedRemainingSlots = remainingSlots;

                    row.find('.remaining-slots').text(`${updatedRemainingSlots} / ${capacity}`);

                    if (updatedRemainingSlots <= 0) {
                        row.find('.register-btn').prop('disabled', true).text('Fully Booked');
                    }

                    $('#registrationForm')[0].reset();
                    $('#registerModal').modal('hide');
                       
                    $('#registeredEventsList').hide();

                    loadEvents();
                }
            });
        });

            // Handle registered events view
            $('#registeredForm').submit(function (e) {
                e.preventDefault();
                const email = $('#userEmail').val();

                if (email === "") {
                    alert("Please enter your email.");
                    return;
                }

                $.get(`get_registered_events.php?email=${email}`, function (response) {
                    const events = JSON.parse(response);
                    const registeredEventsList = $('#registeredEventsList');
                    registeredEventsList.empty(); 

                    if (events.length > 0) {
                        events.forEach(event => {
                            registeredEventsList.append(`
                                <div class="list-group-item list-group-item-light">
                                    <h5>${event.name}</h5>
                                    <p>${event.description}</p>
                                    <small>${event.event_date} | ${event.location}</small>
                                </div>
                            `);
                        });
                    } else {
                        registeredEventsList.append('<div class="list-group-item alert-custom">No registered events found.</div>');
                    }
                        registeredEventsList.show();
                }).fail(function () {
                    alert("An error occurred while fetching registered events.");
                });
    			$('#userEmail').val('');
            });
        });
    </script>
</body>
</html>
