<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <td>Id</td>
                                <td>Initials</td>
                                <td>First name</td>
                                <td>Last name</td>
                                <td>Postcode</td>
                                <td>House number</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Geo</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b border-slate-100">
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['initials'] }}</td>
                                    <td>{{ $user['first_name'] }}</td>
                                    <td>{{ $user['last_name'] }}</td>
                                    <td>{{ $user['zipcode'] }}</td>
                                    <td>{{ $user['house_number'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['phone'] }}</td>
                                    <td>
                                        <ul>
                                            <li>Street: {{ $user['geo']['street'] }}</li>
                                            <li>City: {{ $user['geo']['city'] }}</li>
                                            <li>Province: {{ $user['geo']['province'] }}</li>
                                            <li>Map: <a class="text-red-500" href="https://www.google.com/maps?q={{ $user['geo']['location']['latitude'] }},{{ $user['geo']['location']['longitude'] }}" target="_blank">Google Map Location</a></li>
                                        </ul>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
