<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #87CEEB;
            color: #1f2937;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            padding: 24px;
            margin-bottom: 24px;
        }
        h1, h2, h3 {
            margin-top: 0;
        }
        .quote {
            margin: 0 0 20px;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            font-style: italic;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }
        .btn-primary { background: #2563eb; color: white; }
        .btn-secondary { background: #e2e8f0; color: #0f172a; }
        .btn-danger { background: #dc2626; color: white; }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        label {
            font-size: 14px;
            font-weight: 600;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            min-height: 90px;
            resize: vertical;
        }
        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        th {
            background: #f8fafc;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        .pending {
            background: #fef3c7;
            color: #92400e;
        }
        .completed {
            background: #dcfce7;
            color: #166534;
        }
        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 30px 0;
        }
        .flash {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Task Manager</h1>
                <p class="quote">"Nothing is impossible when you make it possible."</p>
            </div>
        </div>

        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h2>Add New Task</h2>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label for="task_name">Task Name</label>
                        <input id="task_name" type="text" name="task_name" value="{{ old('task_name') }}" required>
                    </div>
                    <div class="field">
                        <label for="due_date">Due Date</label>
                        <input id="due_date" type="date" name="due_date" value="{{ old('due_date') }}" required>
                    </div>
                    <div class="field">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>
                <div class="field" style="margin-top: 16px;">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                </div>
                <div style="margin-top: 16px;">
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2>All Tasks</h2>
            @if($tasks->isEmpty())
                <div class="empty-state">No tasks available. Add your first task above.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->task_name }}</td>
                                <td>{{ $task->description ?: 'No description' }}</td>
                                <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <span class="status-badge {{ strtolower($task->status) }}">{{ $task->status }}</span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary">Edit</a>

                                        <form action="{{ route('tasks.status', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" aria-label="Update task status">
                                                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>

                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
