<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            color: #1f2937;
        }
        .container {
            max-width: 700px;
            margin: 60px auto;
            padding: 0 20px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        label {
            font-weight: 600;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
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
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Task</h1>
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="field">
                        <label for="task_name">Task Name</label>
                        <input id="task_name" type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}" required>
                    </div>
                    <div class="field">
                        <label for="due_date">Due Date</label>
                        <input id="due_date" type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="field">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>

                <div class="field" style="margin-top: 16px;">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Update Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
