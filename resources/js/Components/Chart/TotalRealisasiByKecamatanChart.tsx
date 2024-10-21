import { createChartConfig } from '@/lib/chart-helper';
import { formatCurrency } from '@/lib/utils';
import {
    Bar,
    BarChart,
    CartesianGrid,
    Cell,
    LabelList,
    XAxis,
    YAxis,
} from 'recharts';
import { ChartContainer, ChartTooltip, ChartTooltipContent } from '../UI/Chart';

interface TotalRealisasiByKecamatanProps {
    chartData: {
        name: string;
        total_anggaran: number;
        persentase: number;
    }[];
}

const TotalRealisasiByKecamatanChart = ({
    chartData,
}: TotalRealisasiByKecamatanProps) => {
    let chartConfig = createChartConfig(chartData, 'name');

    chartConfig = {
        total_anggaran: {
            label: 'Total Anggaran',
        },
    };

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    const CustomBarLabel = (props: any) => {
        const { y, width, height, value, index } = props;

        const endX = width - 8;
        const middleY = y + height / 2;

        return (
            <g>
                <text
                    x={endX}
                    y={middleY}
                    fill="#fff"
                    textAnchor="end"
                    dominantBaseline="middle"
                    className="text-xs"
                >
                    {chartData[index].name}:{' '}
                    {formatCurrency(value, 'id-ID', 'IDR')}
                </text>
            </g>
        );
    };

    return (
        <ChartContainer config={chartConfig} className="min-h-[455px] w-full">
            <BarChart
                accessibilityLayer
                data={chartData}
                layout="vertical"
                barCategoryGap={8}
            >
                <CartesianGrid horizontal={false} />
                <YAxis
                    dataKey="name"
                    type="category"
                    dx={-10}
                    tickLine={false}
                    axisLine={false}
                    hide
                />
                <XAxis
                    dataKey="total_anggaran"
                    orientation="top"
                    type="number"
                    hide
                />
                <ChartTooltip
                    cursor={false}
                    content={
                        <ChartTooltipContent
                            indicator="line"
                            className="min-w-56 max-w-64"
                        />
                    }
                />
                <Bar data={chartData} dataKey="total_anggaran" minPointSize={5}>
                    <LabelList
                        dataKey="total_anggaran"
                        content={<CustomBarLabel />}
                    />
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

export default TotalRealisasiByKecamatanChart;
