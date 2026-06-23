<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        .filters {
            margin-bottom: 20px;
            font-size: 11px;
            background-color: #f5f5f5;
            padding: 10px;
            border-left: 3px solid #333;
        }

        .summary {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .summary-card {
            flex: 1;
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .summary-card h4 {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }

        .summary-card .value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            page-break-inside: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 11px;
            page-break-inside: avoid;
        }

        table thead {
            background-color: #f0f0f0;
        }

        table th {
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AssetTI - Relatório de Equipamentos e Manutenções</h1>
        <p>Gerado em {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    @if (!empty($filters['category_name']) || !empty($filters['sector_name']) || !empty($filters['equipment_status_label']) || !empty($filters['maintenance_status_label']) || !empty($filters['date_from']) || !empty($filters['date_to']))
        <div class="filters">
            <strong>Filtros Aplicados:</strong><br>
            @if (!empty($filters['category_name']))
                • Categoria: {{ $filters['category_name'] }}<br>
            @endif
            @if (!empty($filters['sector_name']))
                • Setor: {{ $filters['sector_name'] }}<br>
            @endif
            @if (!empty($filters['equipment_status_label']))
                • Status do Equipamento: {{ $filters['equipment_status_label'] }}<br>
            @endif
            @if (!empty($filters['maintenance_status_label']))
                • Status de Manutenção: {{ $filters['maintenance_status_label'] }}<br>
            @endif
            @if (!empty($filters['date_from']))
                • Data Inicial: {{ \Carbon\Carbon::parse($filters['date_from'])->format('d/m/Y') }}<br>
            @endif
            @if (!empty($filters['date_to']))
                • Data Final: {{ \Carbon\Carbon::parse($filters['date_to'])->format('d/m/Y') }}<br>
            @endif
        </div>
    @else
        <div class="filters">
            <strong>Filtros Aplicados:</strong><br>
            Nenhum filtro aplicado.
        </div>
    @endif

    <div class="summary">
        <div class="summary-card">
            <h4>Total de Equipamentos</h4>
            <div class="value">{{ $summary['totalEquipments'] }}</div>
        </div>
        <div class="summary-card">
            <h4>Em Uso</h4>
            <div class="value">{{ $summary['equipmentsInUse'] }}</div>
        </div>
        <div class="summary-card">
            <h4>Em Manutenção</h4>
            <div class="value">{{ $summary['equipmentsInMaintenance'] }}</div>
        </div>
        <div class="summary-card">
            <h4>Total de Manutenções</h4>
            <div class="value">{{ $summary['totalMaintenances'] }}</div>
        </div>
    </div>

    @if ($equipments->isNotEmpty())
        <h2 class="section-title">Equipamentos</h2>
        <table>
            <thead>
                <tr>
                    <th>Patrimônio</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Marca</th>
                    <th>Setor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipments as $equipment)
                    <tr>
                        <td>{{ $equipment->asset_number }}</td>
                        <td>{{ $equipment->name }}</td>
                        <td>{{ $equipment->category?->name ?? '—' }}</td>
                        <td>{{ $equipment->brand?->name ?? '—' }}</td>
                        <td>{{ $equipment->sector?->name ?? '—' }}</td>
                        <td>{{ $equipment->statusLabel() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="section-title">Equipamentos</h2>
        <div class="no-data">Nenhum equipamento encontrado com os filtros aplicados.</div>
    @endif

    @if ($maintenances->isNotEmpty())
        <h2 class="section-title">Manutenções</h2>
        <table>
            <thead>
                <tr>
                    <th>Equipamento</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Técnico</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->equipment?->name ?? '—' }}</td>
                        <td>{{ $maintenance->maintenance_type }}</td>
                        <td>{{ $maintenance->maintenance_date->format('d/m/Y') }}</td>
                        <td>{{ $maintenance->statusLabel() }}</td>
                        <td>{{ $maintenance->user?->name ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="section-title">Manutenções</h2>
        <div class="no-data">Nenhuma manutenção encontrada com os filtros aplicados.</div>
    @endif

    <div class="footer">
        <p>Este relatório foi gerado automaticamente pelo sistema AssetTI.</p>
        <p>{{ config('app.name') }} © {{ now()->year }}</p>
    </div>
</body>
</html>
