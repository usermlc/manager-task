<h1>Your Tasks</h1>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Assigned To</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <!-- Display task details, ensuring special characters are converted to HTML entities -->
            <td><?php echo htmlspecialchars($task['title']); ?></td>
            <td><?php echo htmlspecialchars($task['description']); ?></td>
            <td><?php echo htmlspecialchars($task['status']); ?></td>
            <td><?php echo htmlspecialchars($task['assigned_to_id']); ?></td>
            <td>
                <!-- Links for editing and deleting tasks -->
                <a href="/tasks/edit/<?php echo $task['id']; ?>">Edit</a>
                <a href="/tasks/delete/<?php echo $task['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Form to create a new task -->
<form action="/task/create" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Task title" required>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" placeholder="Task description"></textarea>
    
    <button type="submit">Create Task</button>
</form>
