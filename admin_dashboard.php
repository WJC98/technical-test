<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #dfe6e9); 
            color: #2d3436; 
            margin: 0;
            padding: 0;
        }
            
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #6c5ce7, #a29bfe); 
            color: #fff;
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
            padding-top: 20px;
        }
            
        .sidebar.collapsed {
            width: 70px;
        }
            
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            transition: all 0.3s;
            font-size: 1rem;
        }
            
        .sidebar .nav-link:hover {
            background: #0984e3;
            color: #fff;
            border-radius: 10px;
        }
            
        .sidebar .active {
            background: #0984e3;
            color: white;
        }
            
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
            
        .dashboard-content.collapsed {
            margin-left: 70px;
        }
            
        .card {
            border-radius: 15px;
            background-color: #fff; 
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }
            
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
            
        .card-body {
            padding: 20px;
        }
            
        .card .card-title {
            font-size: 1.5rem;
        }
            
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }
            
        .table {
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            background-color: #fff;
        }
            
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
            
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }
            
        .status-active {
            background-color: #00b894;
            color: #fff;
        }
            
        .status-completed {
            background-color: #d63031;
            color: #fff;
        }
            
        .search-bar {
            margin-bottom: 20px;
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
            
        .btn {
            border-radius: 5px;
            font-weight: 600;
            padding: 12px 20px;
            text-transform: uppercase;
            transition: all 0.3s;
        }
            
        .btn-primary {
            background-color: #6c5ce7;
            border: none;
        }
            
        .btn-primary:hover {
            background-color: #5e4cc4;
        }
            
        .btn-success {
            background-color: #00b894;
            border: none;
        }
            
        .btn-success:hover {
            background-color: #00a482;
        }
            
        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }
            
        .btn-danger:hover {
            background-color: #c0392b;
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

        .is-invalid {
            border-color: #e74c3c;
            box-shadow: 0 0 8px rgba(231, 76, 60, 0.5);
        }
        .invalid-feedback {
            display: block;
            color: #e74c3c;
            font-size: 0.875rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }
            
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
                
            .sidebar.collapsed {
                width: 100%;
            }
                
            .dashboard-content {
                margin-left: 0;
                padding: 10px;
            }
                
            .table-container {
                margin-top: 10px;
            }
                
            .table {
                font-size: 0.9rem;
            }
                
            .card .card-body {
                padding: 5px;
            }
        }

        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #6c5ce7; 
            color: white;
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
            z-index: 999;
        }
            
        .fab:hover {
            background-color: #a29bfe;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column p-3" id="sidebar">
        <h4 class="text-center py-3">
            <i class="fas fa-user-shield"></i> Admin Panel
        </h4>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#createEventModal">
                    <i class="fas fa-calendar-plus"></i> Create Event
                </a>
            </li>
        </ul>
    </div>

    <div class="dashboard-content" id="content">

        <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard</h1>
            <a href="admin_logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary filter-card" data-status="all">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-2x mb-3"></i> 
                        <h5 class="card-title" id="total-events">0</h5>
                        <p class="card-text">Total Events</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card text-white bg-success filter-card" data-status="Active">
                    <div class="card-body text-center">
                        <i class="fas fa-play-circle fa-2x mb-3"></i> 
                        <h5 class="card-title" id="active-events">0</h5>
                        <p class="card-text">Active Events</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger filter-card" data-status="Completed">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-2x mb-3"></i>
                        <h5 class="card-title" id="completed-events">0</h5>
                        <p class="card-text">Completed Events</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Event List</h3>
        <input type="text" id="search-bar" class="form-control search-bar" placeholder="Search events by name or location">
        <div class="table-container">
            <table class="table table-bordered" id="events-table">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div id="pagination-controls" class="d-flex justify-content-center align-items-center">
        </div>
        <ul id="pagination" class="pagination justify-content-center">
        </ul>

    <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create-event-form">
                        <div class="mb-3">
                            <label for="event-name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="event-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="event-description" class="form-label">Description</label>
                            <textarea class="form-control" id="event-description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="event-date" class="form-label">Event Date</label>
                            <input type="datetime-local" class="form-control" id="event-date" required>
                        </div>
                        <div class="mb-3">
                            <label for="event-location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="event-location" required>
                        </div>
                        <div class="mb-3">
                            <label for="event-capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="event-capacity" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="event-status" class="form-label">Status</label>
                            <select class="form-control" id="event-status" required>
                                <option value="Active">Active</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Update Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-event-form">
                        <input type="hidden" id="edit-event-id" />
                        <div class="mb-3">
                            <label for="edit-event-name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="edit-event-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-event-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-event-description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-event-date" class="form-label">Event Date</label>
                            <input type="datetime-local" class="form-control" id="edit-event-date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-event-location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="edit-event-location" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-event-capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="edit-event-capacity" min="1" step="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-event-status" class="form-label">Status</label>
                            <select class="form-control" id="edit-event-status" required>
                                <option value="Active">Active</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this event?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {

        let currentPage = 1; 
        const eventsPerPage = 5; 
        let currentQuery = ''; 

        function getCurrentPageFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page');
            return page ? parseInt(page, 10) : 1; 
        }

        currentPage = getCurrentPageFromURL();

        // Fetch events with pagination and optional search query
        function fetchEvents(page, query = '') {
            $.get('fetch_events.php', { page: page, per_page: eventsPerPage, query: query }, function (data) {
                let events = JSON.parse(data);
                let activeEvents = '';
                let completedEvents = '';
                const totalEvents = events.total;

                events.data.forEach(function (event, index) {
                    const row = `
                        <tr data-id="${event.id}">
                            <td>${(page - 1) * eventsPerPage + index + 1}</td>
                            <td>${event.name}</td>
                            <td>${event.description}</td>
                            <td>${event.event_date}</td>
                            <td>${event.location}</td>
                            <td>${event.capacity}</td>
                            <td>
                                <span class="status-badge ${event.status === 'Active' ? 'status-active' : 'status-completed'}">
                                    ${event.status}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-warning btn-sm edit-btn me-2" data-id="${event.id}" data-bs-toggle="modal" data-bs-target="#editEventModal">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${event.id}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    if (event.status === 'Active') {
                        activeEvents += row;
                    } else if (event.status === 'Completed') {
                        completedEvents += row;
                    }
                });
                
                $('#events-table tbody').html(activeEvents + completedEvents);
                
                renderPagination(totalEvents, query);
            });
        }

        // Handle Pagination rendering
        function renderPagination(totalEvents, query = '') {
            const totalPages = Math.ceil(totalEvents / eventsPerPage);
            let pagination = '';
            for (let i = 1; i <= totalPages; i++) {
                pagination += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="javascript:void(0);" data-page="${i}" data-query="${query}">
                            ${i}
                        </a>
                    </li>
                `;
            }
            $('#pagination').html(pagination);

            // Handle pagination clicks
            $('#pagination .page-link').click(function () {
                const page = $(this).data('page');
                const query = $(this).data('query');
                currentPage = page;  
                fetchEvents(page, query); 

                const url = new URL(window.location);
                url.searchParams.set('page', page);
                window.history.pushState({}, '', url);  
            });
        }

        // Fetch summary data for info cards (Total, Active, and Completed Events)
        function fetchInfoCards() {
            $.get('fetch_info_cards.php', function (data) {
                let info = JSON.parse(data);
                $('#total-events').text(info.total_events);
                $('#active-events').text(info.active_events);
                $('#completed-events').text(info.completed_events);
            });
        }

        fetchInfoCards();
        fetchEvents(currentPage, currentQuery);

        // Handle search bar input
        $('#search-bar').on('input', function () {
            const query = $(this).val().trim();
            currentQuery = query; 
            currentPage = 1;
            fetchEvents(currentPage, currentQuery);
        });

        // Create event
        $('#create-event-form').submit(function(event) {
            event.preventDefault();
            const name = $('#event-name').val();
            const description = $('#event-description').val();
            const eventDate = $('#event-date').val();
            const location = $('#event-location').val();
            const capacity = $('#event-capacity').val();
            const status = $('#event-status').val();

            $.post('create_event.php', {
                name: name,
                description: description,
                event_date: eventDate,
                location: location,
                capacity: capacity,
                status: status
            }, function(response) {
                if (response === 'success') {
                    alert('Event created successfully.');
                    $('#createEventModal').modal('hide');
                    $('#create-event-form')[0].reset(); 
                    fetchEvents(currentPage);
                    fetchInfoCards();
                } else {
                    alert('Error creating event');
                }
            });
        });

        // Edit Event
        $(document).on('click', '.edit-btn', function() {
            const eventId = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: 'fetch_event.php',
                data: { id: eventId },
                success: function(response) {
                    const event = JSON.parse(response);
                    if (event) {
                        $('#edit-event-id').val(event.id);
                        $('#edit-event-name').val(event.name);
                        $('#edit-event-description').val(event.description);
                        $('#edit-event-date').val(event.event_date);
                        $('#edit-event-location').val(event.location);
                        $('#edit-event-capacity').val(event.capacity);
                        $('#edit-event-status').val(event.status);

                        $('#editEventModal').modal('show');
                    } else {
                        alert("Event not found.");
                    }
                },
                error: function() {
                    alert("Error fetching event data.");
                }
            });
            $('#search-bar').val('');
            $('#editEventModal').on('hide.bs.modal', function () {
               fetchEvents(currentPage);
            });
        });

        // Handle form submission for editing an event
        $('#edit-event-form').submit(function(event) {
            event.preventDefault();

            const eventId = $('#edit-event-id').val();
            const name = $('#edit-event-name').val();
            const description = $('#edit-event-description').val();
            const eventDate = $('#edit-event-date').val();
            const location = $('#edit-event-location').val();
            const capacity = $('#edit-event-capacity').val();
            const status = $('#edit-event-status').val();

            $.ajax({
                type: 'POST',
                url: 'update_event.php',
                data: {
                    id: eventId,
                    name: name,
                    description: description,
                    event_date: eventDate,
                    location: location,
                    capacity: capacity,
                    status: status
                },
                success: function(response) {
                    if (response === 'success') {
                        alert('Event updated successfully.');
                        $('#editEventModal').modal('hide');
                        fetchEvents(currentPage);
                        fetchInfoCards();
                    } else {
                        alert("Error: " + response);
                    }
                },
                error: function() {
                    alert('Error updating event');
                }
            });
        });

        // Delete Event
        $(document).on('click', '.delete-btn', function () {
            const eventId = $(this).data('id');
            $('#confirm-delete-btn').data('id', eventId);
            $('#deleteEventModal').modal('show');
            $('#search-bar').val('');
        });

        // Confirm Delete Event
        $('#confirm-delete-btn').click(function () {
            const eventId = $(this).data('id');
            $.post('delete_event.php', { id: eventId }, function (response) {
                if (response === 'success') {
                    alert('Event deleted successfully.');
                    $('#deleteEventModal').modal('hide');
                    fetchEvents(currentPage); 
                    fetchInfoCards(); 
                } else {
                    alert('Error deleting event');
                }
            });
        });

        $('#deleteEventModal').on('hide.bs.modal', function () {
            $('#search-bar').val(''); 
            fetchEvents(currentPage); 
        });
    });
</script>

</body>
</html>
