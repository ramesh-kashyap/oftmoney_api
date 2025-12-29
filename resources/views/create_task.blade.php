
<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f3f4f6;
    }

    .page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .container {
        width: 100%;
        max-width: 480px;
    }

    .card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e5e7eb;
        text-align: center;
    }

    .card-header h1 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        font-size: 14px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59,130,246,0.25);
    }

    .form-submit {
        margin-top: 20px;
        text-align: center;
    }

    .form-submit button {
        background-color: #2563eb;
        color: #ffffff;
        border: none;
        padding: 10px 26px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .form-submit button:hover {
        background-color: #1d4ed8;
    }
</style> 

@include("layouts.app")

<div class="page">
    <div class="container">

        <div class="card">

            <!-- Header -->
            <div class="card-header">
                <h1>Create New Task</h1>
            </div>

            <!-- Form -->
            <div class="card-body">
                <form action="{{ route('store_task') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Task Name</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Reward Coins</label>
                        <input type="number" name="reward_coins" required>
                    </div>

                    <div class="form-submit">
                        <button type="submit">Create Task</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>


@include("layouts.footer")

