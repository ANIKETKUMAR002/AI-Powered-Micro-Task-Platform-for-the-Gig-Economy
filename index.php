<form id="taskForm">
    <textarea name="description" placeholder="Enter task description"></textarea>
    <button type="submit">Create Task</button>
</form>
<div id="suggestions"></div>

<script>
    document.getElementById('taskForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const description = e.target.description.value;

        const response = await fetch('/api/tasks/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer YOUR_JWT_TOKEN'
            },
            body: JSON.stringify({ description })
        });

        const data = await response.json();
        document.getElementById('suggestions').innerHTML = `
            <p>Task Format: ${data.suggestions.task_format}</p>
            <p>Estimated Time: ${data.suggestions.estimated_time}</p>
            <p>Pricing: ${data.suggestions.pricing}</p>
        `;
    });
</script>
