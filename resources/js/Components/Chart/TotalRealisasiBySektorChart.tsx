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

interface TotalRealisasiBySektorChartProps {
    chartData: {
        name: string;
        total_anggaran: number;
        persentase: number;
    }[];
}

const TotalRealisasiBySektorChart = ({
    chartData,
}: TotalRealisasiBySektorChartProps) => {
    let chartConfig = createChartConfig(chartData, 'name');

    chartConfig = {
        total_anggaran: {
            label: 'Total Anggaran',
        },
    };

    const renderCustomizedLabel = (props) => {
        const { x, y, width, height, index, value } = props;

        const fireOffset = value.toString().length < 5;
        const offset = fireOffset ? -40 : 5;
        return (
            <text
                x={x + width - offset}
                y={y + height - 18}
                fill={fireOffset ? '#285A64' : '#fff'}
                textAnchor="end"
            >
                {`${chartData[index].name}: ${formatCurrency(value, 'id-ID', 'IDR')}`}
            </text>
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
                <Bar dataKey="total_anggaran" type="number" minPointSize={2}>
                    <LabelList
                        dataKey="total_anggaran"
                        position="insideRight"
                        fill="white"
                        content={renderCustomizedLabel}
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

export default TotalRealisasiBySektorChart;
