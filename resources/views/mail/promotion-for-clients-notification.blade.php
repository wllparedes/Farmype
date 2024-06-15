@component('mail::message')
# Nueva promoción

Hola {{ $client->names_surnames }}, se ha creado una nueva promoción que podría interesarte.

<ul>
    <li>Farmacia: {{ $promotion->user->names_surnames }}</li>
    <li>Número de promoción: {{ $promotion->number_promotion }}</li>
    <li>Precio: {{ $promotion->price }}</li>
    <li>Stock: {{ $promotion->stock }}</li>
    <li>Desde: {{ $promotion->date_start }}</li>
    <li>Hasta: {{ $promotion->date_end }}</li>
</ul>

Productos:

@foreach($promotion->products as $product)
<ul>
    <li>Nombre: {{ $product->name }}</li>
    <li>Descripción: {{ $product->detail ?? '-' }}</li>
</ul>
@endforeach


Gracias,<br>
{{ config('app.name') }}
@endcomponent
