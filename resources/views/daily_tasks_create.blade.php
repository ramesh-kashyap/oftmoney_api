@extends("layouts.app")
@section("content")

<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f3f4f6;
    }

    .page-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .card {
        width: 60%;
        max-width: 900px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header {
        padding: 20px 30px;
        border-bottom: 1px solid #e5e7eb;
        texttext-align: center;
    }

    .card-header h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
        text-align: center;
    }

    .card-body {
        padding: 30px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 4fr;
        gap: 20px;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-row label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .form-row input,
    .form-row textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-row textarea {
        resize: vertical;
    }

    .form-row input:focus,
    .form-row textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
    }

    .form-submit {
        text-align: center;
        margin-top: 30px;
    }

    .form-submit button {
        background-color: #16a34a;
        color: #ffffff;
        border: none;
        padding: 10px 40px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .form-submit button:hover {
        background-color: #15803d;
    }

    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-wrapper">
    <div class="card">

        <!-- Header -->
        <div class="card-header">
            <h2>Create New Daily Task</h2>
        </div>

        <!-- Form -->
        <div class="card-body">
            <form action="{{ route('store_daily_task') }}" method="POST">
                @csrf

                <div class="form-row">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-row">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" required></textarea>
                </div>

                <div class="form-row">
                    <label for="required_login_streak">Login Streak</label>
                    <input type="number" name="required_login_streak" min="1" max="10" required>
                </div>

                <div class="form-row">
                    <label for="reward_coins">Reward Coins</label>
                    <input type="number" name="reward_coins" required>
                </div>

                <div class="form-submit">
                    <button type="submit">Submit</button>
                </div>

            </form>
        </div>

    </div>
</div>


@endsection