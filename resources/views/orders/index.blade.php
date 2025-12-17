<div class="card">
    <div class="overflow-x-auto">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Order #</th>
                    <th scope="col">Order Date</th>
                    <th scope="col" width="40%">Products</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-right">Order Total</th>
                    <th scope="col" class="text-right">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td class="!font-semibold">
                            <a class="link link-animated link-primary"
                                href="{{ route('account.orders.show', $order) }}">{{ $order->order_number }}</a>
                        </td>

                        <td>
                            {{ $order->order_date->format(setting('general.date_format')) }}
                        </td>

                        <td class="!whitespace-normal !break-words">
                            {{ $order->items->pluck('product.name')->implode(', ') }}
                        </td>
                        <td class="text-center">
                            <span
                                class=" badge badge-soft badge-{{ $order->status->color() }}">{{ $order->status->label() }}</span>
                        </td>
                        <td class="text-right">@money($order->grand_total)</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline btn-primary"
                                href="{{ route('account.orders.show', $order) }}">View
                                Order</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Orders Found !!!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
