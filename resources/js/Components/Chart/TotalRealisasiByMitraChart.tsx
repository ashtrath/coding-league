import { createChartConfig } from '@/lib/chart-helper';
import { formatCurrency } from '@/lib/utils';
import { Bar, BarChart, CartesianGrid, Cell, XAxis, YAxis } from 'recharts';
import { ChartContainer, ChartTooltip, ChartTooltipContent } from '../UI/Chart';

interface TotalRealisasiByMitraChartProps {
    chartData: {
        name: string;
        total_anggaran: number;
        persentase: number;
    }[];
}

const TotalRealisasiByMitraChart = ({
    chartData,
}: TotalRealisasiByMitraChartProps) => {
    let chartConfig = createChartConfig(chartData, 'name');

    chartConfig = {
        total_anggaran: {
            label: 'Total Anggaran',
        },
    };

    return (
        <ChartContainer config={chartConfig} className="min-h-[455px] w-full">
            <BarChart accessibilityLayer data={chartData} layout="vertical">
                <CartesianGrid horizontal={false} />
                <YAxis
                    dataKey="name"
                    type="category"
                    tickLine={false}
                    tickMargin={10}
                    axisLine={false}
                    hide
                />
                <XAxis dataKey="total_anggaran" type="number" hide />
                <ChartTooltip
                    cursor={false}
                    content={
                        <ChartTooltipContent
                            indicator="line"
                            className="w-56"
                        />
                    }
                />
                <Bar
                    dataKey="total_anggaran"
                    label={{
                        position: 'insideRight',
                        formatter: (value: number) =>
                            formatCurrency(value, 'id-ID', 'IDR'),
                        fill: 'white',
                        offset: 16,
                    }}
                    minPointSize={2}
                >
                    {chartData.map((entry, index) => (
                        <Cell
                            key={`cell-${index}`}
                            fill={`var(--chart-${index + 1})`}
                        />
                    ))}
                </Bar>
            </BarChart>
        </ChartContainer>
    );
};

export default TotalRealisasiByMitraChart;
