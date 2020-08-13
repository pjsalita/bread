<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Customer;
use Schema;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $columns = implode(Schema::getColumnListing('customers'), ',');

        $rules = [
            'per_page' => 'numeric|regex:/^[0-9]+/|not_in:0',
            'sort' => "in:$columns",
            'order' => 'in:asc,desc',
        ];

        $messages = [
            'per_page.numeric' => 'Per page field only accepts positive numbers',
            'per_page.regex' => 'Per page field only accepts positive numbers',
            'sort.in' => "Invalid column name on sort field. Accepts: $columns",
            'order.in' => 'Invalid order value. Accepts: asc,desc',
        ];

        $this->validate($request, $rules, $messages);

        $per_page = $request->input('per_page') ?? 10;
        $sort = $request->input('sort') ?? 'id';
        $order = $request->input('order') ?? 'asc';

        $customers = Customer::orderBy($sort, $order)->paginate($per_page);

        return response($customers, 200);
    }

    public function show($id)
    {
        return response(Customer::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request, true);

        Customer::findOrFail($id)->update($request->input());

        $customer = Customer::find($id);

        $response = [
            'message' => 'Customer successfully updated.',
            'customer' => $customer
        ];

        return response($response, 200);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $customer = Customer::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'date_of_birth' => $request->input('date_of_birth'),
            'is_active' => $request->input('is_active'),
        ]);

        $response = [
            'message' => 'Customer successfully created.',
            'customer' => $customer
        ];

        return response($response, 201);
    }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return response(['message' => 'Customer successfully deleted.'], 200);
    }

    protected function validateRequest($request, $update = false)
    {
        $option = $update ? 'nullable' : 'required';

        $rules = [
            'firstname' => "$option|string",
            'lastname' => "$option|string",
            'date_of_birth' => "$option|date",
            'is_active' => "$option|in:0,1",
        ];

        $messages = [
            'is_active.in' => 'Invalid is_active value. Accepts: 0,1',
        ];

        return $this->validate($request, $rules, $messages);
    }
}
