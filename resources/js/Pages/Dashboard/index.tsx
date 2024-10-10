import StatisticsCard from '@/Components/Card/StatisticsCard';
import DashboardFilter from '@/Components/Select/DashboardFilter';
import MainDashboardLayout from '@/Layouts/MainDashboardLayout';
import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';
import {
    RiDashboardLine,
    RiMoneyDollarCircleLine,
    RiUser3Line,
    RiVerifiedBadgeLine,
} from '@remixicon/react';

export default function Dashboard({ analytics }: PageProps) {
    return (
        <MainDashboardLayout>
            <Head title="Dashboard" />

            <section className="space-y-6">
                <DashboardFilter />
                <h2 className="text-[28px] font-semibold leading-[44px] tracking-tight text-gray-900">
                    Data Statistik
                </h2>
                <div className="flex items-baseline gap-6">
                    <StatisticsCard
                        icon={RiDashboardLine}
                        title="Total Proyek CSR"
                        value={analytics.total_project}
                        color="orange"
                    />
                    <StatisticsCard
                        icon={RiVerifiedBadgeLine}
                        title="Proyek Terealisasi"
                        value={analytics.total_project_terealisasi}
                        color="purple"
                    />
                    <StatisticsCard
                        icon={RiUser3Line}
                        title="Mitra Bergabung"
                        value={analytics.total_mitra}
                        color="blue"
                    />
                    <StatisticsCard
                        icon={RiMoneyDollarCircleLine}
                        title="Total Dana Realisasi"
                        value={`Rp. ${analytics.total_anggaran_realisasi}`}
                        color="green"
                    />
                </div>
            </section>
        </MainDashboardLayout>
    );
}
