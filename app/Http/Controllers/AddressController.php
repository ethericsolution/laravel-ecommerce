<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\StoreRequest as AddressStoreRequest;
use App\Http\Requests\Address\UpdateRequest as AddressUpdateRequest;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $addresses = auth()->user()->addresses;

        $rightSideView = 'addresses.index';

        $pageTitle = 'Your Addresses';

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $address = new Address();

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        $rightSideView = 'addresses.form';

        $pageTitle = 'Add new Address';

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => route('account.addresses.index'), 'text' => 'Your Addresses'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'address', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressStoreRequest $request)
    {

        $validated = $request->validated();

        if ($validated['is_default']) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        auth()->user()->addresses()->create($validated);

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address Added Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address): View
    {
        $userAddress = auth()->user()->addresses()->where('id', $address->id)->first();

        if (is_null($userAddress)) {
            abort(404);
        }

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        $rightSideView = 'addresses.form';

        $pageTitle = "Edit {$address->name}";

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => route('account.addresses.index'), 'text' => 'Your Addresses'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'address', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {

        $validated = $request->validated();

        $userAddress = auth()->user()->addresses()->where('id', $address->id)->first();

        if (is_null($userAddress)) {
            abort(404);
        }

        if ($validated['is_default']) {
            auth()->user()->addresses()->update(['is_default' => false]);
            $validated['is_default'] = true;
        }

        $address->fill($validated);
        $address->save();

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $userAddress = auth()->user()->addresses()->where('id', $address->id)->first();

        if (is_null($userAddress)) {
            abort(404);
        }

        $address->delete();

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address deleted Successfully!!!');
    }

    public function setDefault(Address $address)
    {
        $userAddress = auth()->user()->addresses()->where('id', $address->id)->first();

        if (is_null($userAddress)) {
            abort(404);
        }

        auth()->user()->addresses()->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address set as default Successfully!!!');
    }
}
