import { createChartConfig } from '@/lib/chart-helper';
import { formatCurrency } from '@/lib/utils';
import { Cell, Pie, PieChart } from 'recharts';
import {
    ChartContainer,
    ChartLegend,
    ChartTooltip,
    ChartTooltipContent,
} from '../UI/Chart';

interface PersentaseAnggaranBySektorChartProps {
    chartData: {
        name: string;
        total_anggaran: number;
        persentase: number;
    }[];
}

const PersentaseAnggaranBySektorChart = ({
    chartData,
}: PersentaseAnggaranBySektorChartProps) => {
    const chartConfig = createChartConfig(chartData, 'name');

    return (
        <ChartContainer config={chartConfig} className="min-h-[250px] w-full">
            <PieChart className="w-full" data={chartData}>
                <ChartTooltip
                    content={
                        <ChartTooltipContent
                            nameKey="persentase"
                            labelKey="sektor"
                            className="w-fit border-none bg-gray-900/90 px-4 text-center text-white"
                            formatter={(value, name, { payload }) =>
                                formatCurrency(
                                    payload.payload.total_anggaran,
                                    'id-ID',
                                    'IDR',
                                )
                            }
                        />
                    }
                />
                <ChartLegend
                    content={({ payload }) => {
                        if (!payload?.length) {
                            return null;
                        }

                        return (
                            <ul className="flex flex-col items-start justify-start gap-2 py-0">
                                {payload.map((entry, index) => (
                                    <li
                                        key={`item-${index}`}
                                        className="flex items-center gap-1.5 [&>svg]:size-3 [&>svg]:text-gray-500"
                                    >
                                        <div
                                            className="size-3 rounded-full"
                                            style={{
                                                backgroundColor: entry.color,
                                            }}
                                        />
                                        {entry.value}:{' '}
                                        {entry.payload?.value.toFixed(1)}%
                                    </li>
                                ))}
                            </ul>
                        );
                    }}
                    layout="vertical"
                    verticalAlign="middle"
                    align="right"
                    className="-translate-y-2 flex-wrap gap-2 [&>*]:items-center [&>*]:justify-center"
                />
                <Pie
                    data={chartData}
                    dataKey="persentase"
                    stroke="white"
                    strokeWidth={2}
                >
                    {chartData.map((entry, index) => (
                        <Cell
                            key={`cell-${index}`}
                            fill={`var(--chart-${index + 1})`}
                        />
                    ))}
                </Pie>
            </PieChart>
        </ChartContainer>
    );
};

export default PersentaseAnggaranBySektorChart;
