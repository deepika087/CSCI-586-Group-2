__author__ = 'deepika'

import csv

KeyList = ['uuid',
'country_code',
'age',
'gender',
'education_level',
'degree_of_urbanisation',
'residency',
'household_size',
'immigration',
'origin',
'settlement_size',
'hometown',
'ethnicity',
'religion',
'employment_status',
'employment_status_in_education',
'work_type_routine',
'work_type_manual',
'lgbtq',
'income_net_monthly',
'disposable_income',
'household_finances_past12months',
'financial_security',
'change_household_finances_next12months',
'job_security',
'status_national_economy',
'change_economy_country_past12months',
'economy_country_next12months',
'social_networks_regularly_used',
'social_media_activity_rank',
'online_sharing_frequency',
'sharing_network_size',
'member_organization',
'organization_activities_timeperweek',
'media_tv_hours',
'media_radio_hours',
'media_print_hours',
'opinion_government',
'political_view',
'likelihood_to_demonstrate',
'vote_for_in_us_election',
'frequency_of_voting',
'vote_next_national_election',
'important_issues_when_voting',
'ranking_importance_of_issues_when_voting',
'preferred_type_of_political_leader',
'frequent_sharing_of_politicalviews',
'independence_or_respect',
'obedience_or_selfreliance',
'consideration_or_good_behaviour',
'curiosity_or_good_manners',
'democracy_own_country_satisfaction',
'next_generation_opportunities',
'currentplace_change_past5years',
'hometown_change_past5years',
'country_direction_past5years',
'financial_situation_change_past5years',
'international_trade_gain_or_loss',
'country_comes_first',
'improving_life_by_hardwork',
'conspiracy',
'government_controlled_by_elite',
'trust_in_own_judgment',
'perceived_effect_of_diversity',
'gender_discrimination_importance',
'family_friends_highereducation',
'worldview'
        ]

DEL = "~"
count = 0
writer = open("/Users/deepika/MyStuff/CSCI_DBI/filtered_trump_dataset.csv", "w")
writer = csv.writer(writer, delimiter = ",")
header = ""
for _k in KeyList:
    header += _k + DEL
writer.writerow([ header[0:len(header)-1] ])

with open("/Users/deepika/MyStuff/CSCI_DBI/trump_dataset.csv", 'rU') as f:
    reader = csv.DictReader(f, dialect=csv.excel_tab, delimiter=',')
    for row in reader:
        result = ""
        if row['uuid'] is None or len(row['uuid']) == 0:
            break
        else:
            for _k in KeyList:
                if row[_k] == "" or len(row[_k]) == 0:
                    result += "NA" +  DEL
                else:
                    result += row[_k] + DEL
            #print "Writing: ", result[0:len(result)-1]
            writer.writerow([result[0:len(result)-1]])
        count = count + 1
    print count