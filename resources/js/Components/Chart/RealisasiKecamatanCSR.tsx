import { createChartConfig } from '@/lib/chart-helper';
import { BaseAnggaranCSR } from '@/types';
import {
    Bar,
    BarChart,
    CartesianGrid,
    LabelList,
    XAxis,
    YAxis,
} from 'recharts';
import { ChartContainer, ChartTooltip, ChartTooltipContent } from '../UI/Chart';

interface RealisasiSektorCSRProps {
    chartData: BaseAnggaranCSR[];
}

const RealisasiKecamatanCSR = ({ chartData }: RealisasiSektorCSRProps) => {
    let chartConfig = createChartConfig(chartData, 'name', 'total_anggaran');

    chartConfig = {
        total_anggaran: {
            label: 'Total Anggaran',
        },
    };

    return (
        <ChartContainer config={chartConfig}>
            <BarChart
                accessibilityLayer
                data={chartData}
                layout="vertical"
                margin={{
                    right: 16,
                }}
            >
                <CartesianGrid horizontal={false} />
                <YAxis
                    dataKey="name"
                    type="category"
                    tickLine={false}
                    tickMargin={10}
                    axisLine={false}
                    tickFormatter={(value) => value.slice(0, 3)}
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
                <Bar dataKey="total_anggaran" layout="vertical" radius={4}>
                    <LabelList
                        dataKey="name"
                        position="insideLeft"
                        offset={8}
                        fontSize={13}
                        className="fill-white font-sans"
                    />
                    <LabelList
                        formatter={(value: string | number) => {
                            return `Rp. ${value.toLocaleString()}`;
                        }}
                        dataKey="total_anggaran"
                        position="insideRight"
                        offset={8}
                        fontSize={13}
                        className="fill-white font-sans"
                    />
                </Bar>
            </BarChart>
        </ChartContainer>
    );
};

export default RealisasiKecamatanCSR;
