<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
class TelegramUserController extends Controller
{
    public function referredUsers(Request $request)
    {
        $user = $request->user();

        $referredUsers = TelegramUser::with(['level'])
            ->where('referred_by', $user->telegram_id)
            ->paginate($request->get('per_page') ?? 10);

        return JsonResource::collection($referredUsers);
    }


      public function teamSummary(Request $request)
    {
        $user = $request->user();

        // 🔹 Get full team user IDs (all levels)
        $teamUserIds = $this->my_level_team_count($user->telegram_id);

        if (empty($teamUserIds)) {
            return response()->json([
                'total_team' => 0,
                'valid_team' => 0,
                'total_deposit' => 0,
                'total_withdrawal' => 0,
                'levels' => [],
            ]);
        }

        // 🔹 Total team count
        $totalTeam = count($teamUserIds);

        // 🔹 Valid team (example: users with any active package)
        $validTeam = DB::table('telegram_users')
            ->whereIn('telegram_id', $teamUserIds)
            ->where('active_status', 'Active')
            ->count('id');

        // 🔹 Total team deposit
        $totalDeposit = DB::table('investments')
            ->whereIn('user_id_fk', $teamUserIds)
            ->where('status', 'Active')
            ->sum('amount');

        // 🔹 Total team withdrawal
        $totalWithdrawal = DB::table('withdraws')
            ->whereIn('user_id_fk', $teamUserIds)
            ->where('status', 'Approved')
            ->sum('amount');

        // 🔹 Level-wise data
        $levels = $this->levelWiseData($user->telegram_id, 25);

        return response()->json([
            'total_team' => $totalTeam,
            'valid_team' => $validTeam,
            'total_deposit' => round($totalDeposit, 2),
            'total_withdrawal' => round($totalWithdrawal, 2),
            'levels' => $levels,
        ]);
    }

    /**
     * 🔁 Your existing logic (unchanged)
     */
    public function my_level_team_count($userid)
    {
        $arrin = [$userid];
        $ret = [];
        $i = 1;

        while (!empty($arrin)) {
            $alldown = \DB::table('telegram_users')->select('telegram_id')
                ->whereIn('referred_by', $arrin)
                ->get()
                ->toArray();

            if (!empty($alldown)) {
                $arrin = array_column($alldown, 'telegram_id');
                $ret[$i] = $arrin;
                $i++;
            } else {
                $arrin = [];
            }
        }

        $final = [];
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }

    /**
     * 📊 Level-wise team summary
     */
    public function levelWiseData($userid, $maxLevel = 25)
    {
        $arrin = [$userid];
        $levels = [];

        for ($level = 1; $level <= $maxLevel; $level++) {
            $next = \DB::table('telegram_users')->whereIn('referred_by', $arrin)->pluck('telegram_id')->toArray();

            if (empty($next)) {
                break;
            }

            // valid users at this level
            $valid = DB::table('telegram_users')
                ->whereIn('telegram_id', $next)
                ->where('active_status', 'Active')
                ->count('id');

            $levels[] = [
                'level' => $level,
                'total' => count($next),
                'valid' => $valid,
            ];

            $arrin = $next;
        }

        return $levels;
    }


        // 👇 USERS OF SPECIFIC LEVEL
    public function levelUsers(Request $request)
    {
        $request->validate([
            'level' => 'required|integer|min:1',
        ]);

         $user = $request->user();

        $ids = $this->getUsersByLevel($user->telegram_id, $request->level);

        return \DB::table('telegram_users')->whereIn('telegram_id', $ids)
            ->select('id', 'first_name', 'last_name', 'package', 'created_at','active_status')
            ->paginate(10);
    }

    // 👇 LEVEL LOGIC
    private function getUsersByLevel($userId, $targetLevel)
    {
        $current = [$userId];

        for ($i = 1; $i <= $targetLevel; $i++) {
            $next = \DB::table('telegram_users')->whereIn('referred_by', $current)->pluck('telegram_id')->toArray();
            if (empty($next)) return [];
            $current = $next;
        }

        return $current;
    }

}
