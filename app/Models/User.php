use App\Models\User;
use Illuminate\Support\Facades\Hash;

public function login(Request $request)
{
    // 1. Validate Input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2. Find User using the HASH, not the plain email
    // We hash the input email to match the 'email_hash' column in your DB
    $user = User::where('email_hash', hash('sha256', $request->email))->first();

    // 3. Check Password
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid Credentials'
        ], 422);
    }

    // 4. Create Token (Success!)
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login success',
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user,
    ]);
}